<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class DataTableListService {

	protected $query;
    protected $columns = [];
    protected $filters = [];

    public function setQuery(Builder $query) {
        $this->query = $query;
        return $this;
    }

    public function setColumns(array $columns) {
        $this->columns = $columns;
        return $this;
    }

    public function setFilters(array $filters) {
        $this->filters = $filters;
        return $this;
    }


    public function render(Request $request) {


        if (!$this->query) {
            abort(500, 'Query not set in DataTableListService');
        }

        $draw = (int) $request->get('draw');
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);

        /* handle all types of filters */
        foreach ($this->filters as $field => $callback) {
            $value = $request->get($field);
            if ($value !== null && $value !== '') {
                $callback($this->query, $value);
            }
        }

        /* handle serach request */
        $search = $request->input('search.value');
        if ($search) {
            $this->query->where(function ($q) use ($search) {
                foreach ($this->columns as $col) {
                    $q->orWhere($col, 'like', "%{$search}%");
                }
            });
        }

        /* Count Total Records */
        $recordsTotal = $this->query->count(DB::raw('DISTINCT s.id'));
        $dataQuery = clone $this->query;
        if ($length != -1) {
            $dataQuery->skip($start)->take($length);
        }

        $data = $dataQuery->get();
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data
        ]);


    }
}

