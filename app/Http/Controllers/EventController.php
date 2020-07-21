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
        $show = Event::latest()->get();
        return response()->json(['events' => $show]);
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
            'admin_id' => auth('api')->user()->id,
        ]);

        if ($data) {
            $response = ['code' => 200, 'message' => 'Berhasil menyimpan event'];
        } else {
            $response = ['code' => 401, 'message' => 'Something went wrong!'];
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->month == 0 && $request->year == 0) {
            $show = Event::orderBy('start', 'asc')->get();
            return response()->json(['events' => $show]);
        } else {
            $show = Event::whereMonth('start', $request->month)->whereYear('start', $request->year)->orderBy('start', 'asc')->get();
            return response()->json(['events' => $show]);
        }
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
        $cek = Event::where('id', $id)->count();

        if ($cek = 1) {
            $go = Event::where('id', $id)->update([
                'title' => request('title'),
                'description' => request('description'),
                'start' => request('start'),
                'end' => request('end'),
                'color' => request('color'),
                'admin_id' => auth('api')->user()->id,
            ]);

            if ($go) {
                $response = ['code' => 200, 'message' => 'Berhasil update event'];
            } else {
                $response = ['code' => 401, 'message' => 'Gagal update event'];
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
        // $id = $request->id;
        $data = array_filter(explode(',', $id));
        if (count($data) > 1) {
            for ($i = 0; $i  < count($data); $i++) {
                $event = Event::find($data[$i]);
                $event->delete();
            }
            $response = ['code' => 200, 'message' => 'Berhasil menghapus kegiatan'];
        } else {
            $event = Event::find($id);
            if ($event->delete()) {
                $response = ['code' => 200, 'message' => 'Berhasil menghapus kegiatan'];
            }
        }

        return response()->json($response);
    }
}
