<?php

namespace App\Http\Controllers;
use Jenssegers\Date\Date;
use App\Today;
use App\Thumbnail;
use App\Event;
use App\Rombel;
use App\Attendance;
use App\Major;
use App\MajorAttendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $today = Today::where('date', $now)->orderBy('start', 'asc')->get();
        $total = Rombel::sum('student_total');
        $not_present = Attendance::where('date', $now)->sum('not_present');
        return view('content.main', [
            'today' => $today,
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get(),
            'total' => $total,
            'present' => $total - $not_present,
            'event' => Event::count(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tv()
    {
        $now = date('Y-m-d');
        Date::setLocale('id');
        $total = Rombel::sum('student_total');
        $cek = Attendance::where('date', $now);
        if ($cek->count() < 1) {
            $not_present = 0;
            $present = 0;
        }else{
            $present = $total;
            $not_present = $cek->sum('not_present');
        }
        $today = Today::where('date', $now)->orderBy('start', 'asc')->get();

        $attendance = MajorAttendance::where('date',$now)->latest()->get();

        return view('content.tv-dashboard', [
            'today' => $today,
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get(),
            'now' => Date::now()->format('l, j F Y'),
            'total' => $total,
            'present' => $present - $not_present,
            'not_present' => $not_present,
            'attendance' => $attendance,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
