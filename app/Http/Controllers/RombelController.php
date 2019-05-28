<?php

namespace App\Http\Controllers;

use App\Major;
use App\Rombel;
use App\Attendance;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.rombel.index',[
            'data' => Rombel::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.rombel.create',[
            'majors' => Major::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rombel::create($request->all());

        return redirect()->route('rombel.index')->with('message','menyimpan rombel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function edit(Rombel $rombel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rombel $rombel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rombel $rombel)
    {
        $cek = Attendance::where('rombel_id',$rombel->id)->count();
        if ($cek > 0) {
            return redirect()->route('rombel.index')->withError('Data rombel telah digunakan sehingga tidak dapat dihapus!');
        }else{
            $rombel->delete();
            return redirect()->route('rombel.index')->with('message','menghapus rombel');
        }
    }

    public function rombel(Request $request)
    {
        $rombel = Rombel::where(['major_id'=>$request->major_id, 'grade'=>$request->grade])->count();
        $rombel = $rombel+1;
        switch ($request->grade) {
            case '10':
                $grade = 'X';
                break;
            case '11':
                $grade = 'XI';
                break;
            case '12':
                $grade = 'XII';
                break;
            
            default:
                
                break;
        }
        $major = Major::find($request->major_id);
        return response()->json([
            'rombel'=>$major->alias.' '.$grade.'-'.$rombel,
            'code' => $rombel
        ]);
    }
}
