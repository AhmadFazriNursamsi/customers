<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Models\Useraccess;
use App\Models\Listaccess;
use App\Http\Controllers\HelpersController as Helpers;
use Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apigetdatacustomers(Request $request){
    	
        if($request->name != null ||$request->email||$request->no_tlp|| $request->searchactive != null) {
            $whereraw = '';
            if($request->name != null) $whereraw .= " and name like '%$request->name%'";
            if($request->email != null) $whereraw .= " and email like '%$request->email%'";
            if($request->no_tlp != null) $whereraw .= " and no_tlp like '%$request->no_tlp%'";
            if($request->searchactive != null) $whereraw .= " and active like '%$request->searchactive%'";

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1);
    		$users = Customer::whereRaw($whereraw)->get();    	

    	} else {
    		$users = Customer::get();
    	}

    	$datas = [];
		foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->name,$user->email,$user->no_tlp,$user->active,$user->flag_delete,$user->id
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }


    public function index()
    {
        $coba = Customer::all();
        // dd($coba);
        return view("customer.index", compact('coba'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $tatas = new Customer;
     $tatas->name = $request->name;
     $tatas->email = $request->email;
     $tatas->no_tlp = $request->no_tlp;
     $tatas->active = $request->active;
    //  $tatas->flag_delete = $request->flag_delete;
     if($tatas->save())
         return response()->json(['data' => ['success'], 'status' => '200'], 200);
     else 
         return response()->json(['data' => ['false'], 'status' => '200'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id, Customer $customer)
    {
        $datas  = Customer::where('id', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Customer $customer)
    {
        $datas  = Customer::where('id', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Customer $customer)
    {
        $this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

        $tatas = Customer::where('id', $id)->first();
        $tatas->name = $request->name;
        $tatas->email = $request->email;
        $tatas->no_tlp = $request->no_tlp;
        $tatas->active = $request->active;

        if($tatas->save())
            return response()->json(['data' => ['success'], 'status' => '200'], 200);
        else 
            return response()->json(['data' => ['fails'], 'status' => '200'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, Request $request, $id)
    {
        $this->access = Helpers::checkaccess('customers', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas = Customer::where('id',$id)->first();
        $datas->flag_delete = 1;

        if(isset($request->undeleted)) $datas->flag_delete = 0;
        $datas->save();
    
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    
    }
}
