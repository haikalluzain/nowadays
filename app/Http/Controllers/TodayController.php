<?php

namespace App\Http\Controllers;

use App\Today;
use Illuminate\Http\Request;
use Auth;

class TodayController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = Today::latest()->get();
        return response()->json(['todays' => $show]);
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
        $data = new Today($request->all());
        $data->admin_id = auth('api')->user()->id;
        $data->save();

        if ($data) {
            $response = ['code'=>200,'status'=>'success'];
        }else{
            $response = ['code'=>201,'status'=>'error'];
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Today  $today
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $now = date('Y-m-d');
        $show = Today::where('tanggal', $now)->orderBy('mulai', 'asc')->get();
        return response()->json(['todays' => $show]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Today  $today
     * @return \Illuminate\Http\Response
     */
    public function edit(Today $today)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Today  $today
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $go = Today::where('id',$id)->update([
            'activity' => request('activity'),
            'start' => request('start'),
            'end' => request('end'),
            'date' => request('date'),
            'admin_id' => auth('api')->user()->id,
        ]);

        if ($go) {
            $response = ['code'=>200,'status'=>'success'];
        }else{
            $response = ['code'=>201,'status'=>'error'];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Today  $today
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Today::findOrFail($id);

        if($cek->delete()){
            $response = ['status'=>'success','code'=>200];
        }else{
            $response = ['status'=>'error','code'=>201];
        }
        return response()->json($response);
    }
}
