<?php

namespace App\Http\Controllers;
use Jenssegers\Date\Date;
use App\Today;
use App\Thumbnail;
use App\Event;
use App\Rombel;
use App\Attendance;
use App\Major;
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
        return view('content.main', [
            'today' => $today,
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get()
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

        // RPL
        $major_rpl_id = Major::where('alias','RPL');
        $total_rpl = 0;
        if ($major_rpl_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_rpl_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_rpl = Rombel::where('major_id',$major_rpl_id->first()->id)->sum('student_total');
                $rpl = Attendance::where(['date'=>$now,'major_id' => $major_rpl_id->first()->id])->sum('not_present');
                $total_rpl = $rombel_rpl - $rpl;
            }
        }

        // OTKP
        $major_otkp_id = Major::where('alias','OTKP');
        $total_otkp = 0;
        if ($major_otkp_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_otkp_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_otkp = Rombel::where('major_id',$major_otkp_id->first()->id)->sum('student_total');
                $otkp = Attendance::where(['date'=>$now,'major_id' => $major_otkp_id->first()->id])->sum('not_present');
                $total_otkp = $rombel_otkp - $otkp;
            }
        }

        // TKJ
        $major_tkj_id = Major::where('alias','TKJ');
        $total_tkj = 0;
        if ($major_tkj_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_tkj_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_tkj = Rombel::where('major_id',$major_tkj_id->first()->id)->sum('student_total');
                $tkj = Attendance::where(['date'=>$now,'major_id' => $major_tkj_id->first()->id])->sum('not_present');
                $total_tkj = $rombel_tkj - $tkj;
            }
        }

        // BDP
        $major_bdp_id = Major::where('alias','BDP');
        $total_bdp = 0;
        if ($major_bdp_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_bdp_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_bdp = Rombel::where('major_id',$major_bdp_id->first()->id)->sum('student_total');
                $bdp = Attendance::where(['date'=>$now,'major_id' => $major_bdp_id->first()->id])->sum('not_present');
                $total_bdp = $rombel_bdp - $bdp;
            }
        }

        // MMD
        $major_mmd_id = Major::where('alias','MMD');
        $total_mmd = 0;
        if ($major_mmd_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_mmd_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_mmd = Rombel::where('major_id',$major_mmd_id->first()->id)->sum('student_total');
                $mmd = Attendance::where(['date'=>$now,'major_id' => $major_mmd_id->first()->id])->sum('not_present');
                $total_mmd = $rombel_mmd - $mmd;
            }
        }

        // HTL
        $major_htl_id = Major::where('alias','HTL');
        $total_htl = 0;
        if ($major_htl_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_htl_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_htl = Rombel::where('major_id',$major_htl_id->first()->id)->sum('student_total');
                $htl = Attendance::where(['date'=>$now,'major_id' => $major_htl_id->first()->id])->sum('not_present');
                $total_htl = $rombel_htl - $htl;
            }
        }

        // TBG
        $major_tbg_id = Major::where('alias','TBG');
        $total_tbg = 0;
        if ($major_tbg_id->count() > 0) {
            $attendance = Attendance::where(['major_id' => $major_tbg_id->first()->id, 'date'=> $now])->count();
            if ($attendance > 0) {
                $rombel_tbg = Rombel::where('major_id',$major_tbg_id->first()->id)->sum('student_total');
                $tbg = Attendance::where(['date'=>$now,'major_id' => $major_tbg_id->first()->id])->sum('not_present');
                $total_tbg = $rombel_tbg - $tbg;
            }
        }

        return view('content.tv-dashboard', [
            'today' => $today,
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get(),
            'now' => Date::now()->format('l, j F Y'),
            'total' => $total,
            'present' => $present - $not_present,
            'not_present' => $not_present,
            'rpl' => $total_rpl,
            'otkp' => $total_otkp,
            'tkj' => $total_tkj,
            'bdp' => $total_bdp,
            'mmd' => $total_mmd,
            'htl' => $total_htl,
            'tbg' => $total_tbg,
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
