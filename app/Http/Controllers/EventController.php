<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Auth;

class EventController extends Controller
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
        return view('content.event-calendar', [
            'show' => Event::all()
        ]);
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
        $data = Event::create([
                'title' => request('title'),
                'description' => request('description'),
                'start' => request('start'),
                'end' => request('end'),
                'color' => request('color'),
                'admin_id' => Auth::id(),
            ]);

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
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $show = Event::latest()->get();
        return response()->json(['events' => $show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $cek = Event::where('id',$id)->count();

        if ($cek = 1) {
            $go = Event::where('id',$id)->update([
                'title' => request('title'),
                'description' => request('description'),
                'start' => request('start'),
                'end' => request('end'),
                'color' => request('color'),
                'admin_id' => Auth::id(),
            ]);

            if ($go) {
                $response = ['code'=>200,'status'=>'success'];
            }else{
                $response = ['code'=>201,'status'=>'error'];
            }

        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Event::findOrFail($id);

        if($cek->delete()){
            $response = ['status'=>'success','code'=>200];
        }else{
            $response = ['status'=>'error','code'=>201];
        }
        return response()->json($response);
    }
}
