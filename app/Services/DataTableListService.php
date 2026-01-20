<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class DataTableListService {

    protected Builder $query;              
    protected array $filters = [];         
    protected array $customColumns = [];    // Custom columns (computed in PHP)
    protected array $searchable = [];  
    protected array $sortable = [];


    public function setQuery(Builder $query) {
        $this->query = $query;
        return $this;
    }

    public function setFilters(array $filters) {
        $this->filters = $filters;
        return $this;
    }

    public function setSearchableColumns(array $columns) {
        $this->searchable = $columns;
        return $this;
    }


    public function setSortableColumns(array $columns) {
        $this->sortable = $columns;
        return $this;
    }

    public function addCustomColumn($name, \Closure $callback) {
        $this->customColumns[$name] = $callback;
        return $this;
    }

    public function render(Request $request) {
        if (!$this->query) {
            abort(500, 'Query not set in DataTableListService');
        }

        $draw   = (int) $request->get('draw');
        $start  = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);



        $totalQuery = clone $this->query;
        $recordsTotal = $totalQuery->count();

        foreach ($this->filters as $field => $callback) {
            $value = $request->get($field);
            if ($value !== null && $value !== '') {
                $callback($this->query, $value);
            }
        }

        $searchValue = $request->input('search.value');
        if (!empty($searchValue) && count($this->searchable)) {
            $this->query->where(function ($q) use ($searchValue) {
                foreach ($this->searchable as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $searchValue . '%');
                }
            });
        }




/*
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection   = $request->input('order.0.dir', 'asc');
        $requestedColumn  = $request->input("columns.$orderColumnIndex.name");

        if ($requestedColumn && isset($this->sortable[$requestedColumn])) {
            $columnDef = $this->sortable[$requestedColumn];

            if ($columnDef instanceof \Illuminate\Database\Query\Expression) {
                $this->query->orderByRaw($columnDef . ' ' . $orderDirection);
            } else {
                $this->query->orderBy($columnDef, $orderDirection);
            }
        }

*/


        $orderRequests = $request->input('order', []);

        $firstColumnName = $orderRequests[0]['name'] ?? null;
        if (empty($orderRequests) || $firstColumnName === null) {
            $this->query->orderBy('custom_classes.orders', 'ASC')
                    ->orderBy('custom_classes.section', 'ASC')->orderBy(DB::raw('CAST(students.rollno AS UNSIGNED)'), 'ASC');
        }
        

        foreach ($orderRequests as $order) {

            $index = $order['column'];
            $dir   = $order['dir'] === 'desc' ? 'desc' : 'asc';
            $name  = $request->input("columns.$index.name");

            if ($name === 'display_classname') {
                $this->query->orderByRaw("
                    CASE 
                        WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                        THEN custom_classes.nomenclature
                        ELSE class.name
                    END $dir
                ");
                continue;
            }

            if (isset($this->sortable[$name])) {
                $col = $this->sortable[$name];
                if ($col instanceof \Illuminate\Database\Query\Expression) {
                    $this->query->orderByRaw($col . " $dir");
                } else {
                    $this->query->orderBy($col, $dir);
                }
            }
        }       
        

        $filteredQuery = clone $this->query;
        $recordsFiltered = $filteredQuery->count();

        $dataQuery = clone $this->query;
        if ($length != -1) {
            $dataQuery->skip($start)->take($length);
        }
                
        $data = $dataQuery->get();


        foreach ($this->customColumns as $key => $callback) {
            $data->transform(function ($row) use ($key, $callback) {
                $row->$key = $callback($row);
                return $row;
            });
        }


        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal, 
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);


    }

}

