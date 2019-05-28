<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Attendance;
use App\MajorAttendance;
use App\Rombel;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $cek = Attendance::where('date',$now)->count();

        if ($cek == 0) {
            return view('content.attendance.create',[
                'rombels' => Rombel::all()
            ]);
        }else{
            return view('content.attendance.index',[
                'data' => Attendance::where('date',$now)->get()
            ]);    
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.attendance.create',[
            'rombels' => Rombel::whereNotExists(function ($query) {
                $query->select()
                      ->from('attendances')
                      ->whereRaw('attendances.rombel_id = rombels.id')
                      ->where('date',date('Y-m-d'));
            })
            ->orderBy('alias','asc')->get()
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
        $now = date('Y-m-d');
        $rombel = Rombel::find($request->rombel_id);
        $total = $rombel->student_total;

        $this->validate($request,[
            'not_present' => 'numeric|max:'.$total
        ]);

        $absen = new Attendance($request->all());
        $absen->date = Carbon::now();
        $absen->major_id = $rombel->major_id;
        $absen->present = $total - $request->not_present;
        $absen->save();

        $cek = MajorAttendance::where('date',$now);
        if ($cek->count() == 0) {
            MajorAttendance::create([
                'major_id' => $rombel->major_id,
                'present' => $total - $request->not_present,
                'date' => $now
            ]);
        }else{
            $att = MajorAttendance::find($cek->first()->id);
            $att->update([
                'present' => $att->present + $total - $request->not_present
            ]);
        }


        return redirect()->route('attendance.index')->with('message','menyimpan absen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('content.attendance.index',[
            'data' => Attendance::latest()->get()
        ]);
    }

    public function all(Attendance $attendance)
    {
        return view('content.attendance.index',[
            'data' => Attendance::latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
