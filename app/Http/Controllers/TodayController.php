<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

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
        $now = date('Y-m-d');
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

    public function what()
    {
        $what = 'new Date(2019, 4, 5)';
        return response()->json(['what'=>$what]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Today::create([
            'activity' => $request->activity,
            'start' => $request->start,
            'end' => $request->end,
            'admin_id' => auth('api')->user()->id,
            'date' => Carbon::now()
        ]);

        if ($data) {
            $response = ['code'=>200,'message'=>'Success create an activity'];
        }else{
            $response = ['code'=>201,'message'=>'Something went wrong!'];
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
        $show = Today::where('date', $now)->orderBy('start', 'asc')->get();
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
            'date' => Carbon::now(),
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
