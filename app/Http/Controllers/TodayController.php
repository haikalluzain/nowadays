<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Today;
use Illuminate\Http\Request;
use Auth;

class TodayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = Today::orderBy('start', 'asc')->get();
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
        $what = 'new Date(4009, 4, 5)';
        return response()->json(['what' => $what]);
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
        $data->date = Carbon::now();
        $data->save();

        if ($data) {
            $response = ['code' => 200, 'message' => 'Success create an activity'];
        } else {
            $response = ['code' => 400, 'message' => 'Something went wrong!'];
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

        $go = Today::where('id', $id)->update([
            'activity' => request('activity'),
            'start' => request('start'),
            'end' => request('end'),
            'date' => Carbon::now(),
            'admin_id' => auth('api')->user()->id,
        ]);

        if ($go) {
            $response = ['code' => 200, 'message' => 'Success update activity'];
        } else {
            $response = ['code' => 400, 'message' => 'Something went wrong!'];
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
        // $id = $request->id;
        $data = array_filter(explode(',', $id));
        if (count($data) > 1) {
            for ($i = 0; $i  < count($data); $i++) {
                $today = Today::find($data[$i]);
                $today->delete();
            }
            $response = ['code' => 200, 'message' => 'Berhasil menghapus activity'];
        } else {
            $today = Today::find($id);
            if ($today->delete()) {
                $response = ['code' => 200, 'message' => 'Berhasil menghapus activity'];
            }
        }

        return response()->json($response);
    }
}
