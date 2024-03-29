<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('list');
    }

    public function getData(Request $request){

        $draw 				= 		$request->get('draw'); // Internal use
        $start 				= 		$request->get("start"); // where to start next records for pagination
        $rowPerPage 		= 		$request->get("length"); // How many recods needed per page for pagination
     
        $orderArray 	   = 		$request->get('order');
        $columnNameArray 	= 		$request->get('columns'); // It will give us columns array
                          
        $searchArray 		= 		$request->get('search');
        $columnIndex 		= 		$orderArray[0]['column'];  // This will let us know,
                                                           // which column index should be sorted 
                                                           // 0 = id, 1 = name, 2 = email , 3 = created_at
     
        $columnName 		= 		$columnNameArray[$columnIndex]['data']; // Here we will get column name, 
                                                                       // Base on the index we get
     
        $columnSortOrder 	= 		$orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue 		= 		$searchArray['value']; // This is search value 


        $users = \DB::table('users');
        $total = $users->count();

        $totalFilter = \DB::table('users');
        if (!empty($searchValue)){
            $totalFilter = $totalFilter->where('name', 'like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orwhere('email', 'like','%'.$searchValue.'%');
        }
        $totalFilter = $users->count();

        $arrData = \DB::table('users');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName, $columnSortOrder);

        if (!empty($searchValue)){
            $arrData = $arrData->where('name', 'like','%'.$searchValue.'%');
            $arrData = $arrData->orwhere('email', 'like','%'.$searchValue.'%');
        }

        $arrData = $arrData->get();
        
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $arrData,
         );
         return response()->json($response);
    
    }
}
