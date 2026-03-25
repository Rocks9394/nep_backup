<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Sstudent;
use App\Models\Sclass;
use App\Models\CustomClass;
use Carbon\Carbon;
use DB;

class Fitness365Controller extends Controller
{

    public function stateData(){
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('CISCE_Bearer_TOKEN')
            ])->get('https://active.cisce.org/api/states-data');

            return $response->json();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function stateWiseFitnessData(){
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('CISCE_Bearer_TOKEN')
            ])->get('https://active.cisce.org/api/states-fitness-data');

            return $response->json();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
