<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Overtime;
use Auth;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Requests\AddOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overtimes = Overtime::where('user_id', Auth::user()->id)->paginate(config('app.pagination'));
        $data = [
            'overtimes' => $overtimes,
        ];
        return view("employees.overtime.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employees.overtime.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddOvertimeRequest $request)
    {
        $overtimes = new Overtime();
        $overtimes->date = $request->date;
        $overtimes->start_time = $request->from;
        $overtimes->end_time = $request->to;
        $overtimes->content = $request->content;
        // count hours OT
        $toTime = strtotime($overtimes->end_time);
        $fromTime = strtotime($overtimes->start_time);
        $hour = ceil($toTime - $fromTime)/(60*60);
        $overtimes->hours = $hour;
        $overtimes->user_id = Auth::user()->id;
        
        $overtimes->save();
        $request->session()->flash('success',trans('message.add_success'));
        return redirect()->route('overtime.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $overtimes = Overtime::findOrFail($id);
        $data = [
            'overtimes' => $overtimes,
        ];
        return view("employees.overtime.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtimes = Overtime::findOrFail($id);
         $data = [
            'overtimes' => $overtimes,
        ];
        return view("employees.overtime.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOvertimeRequest $request, $id)
    {
        $overtimes = Overtime::findOrFail($id);
        $overtimes->date = $request->date;
        $overtimes->start_time = $request->from;
        $overtimes->end_time = $request->to;
        $overtimes->content = $request->content;
        // count hours OT
        $toTime = strtotime($overtimes->end_time);
        $fromTime = strtotime($overtimes->start_time);
        $hour = ceil($toTime - $fromTime)/(60*60);
        $overtimes->hours = $hour;
        $overtimes->user_id = Auth::user()->id;
        $overtimes->save();
        $request->session()->flash('success', trans('message.edit_success'));
        return redirect()->route('overtime.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $overtimes = Overtime::findOrFail($id);
        $overtimes->delete();
        return redirect()->route('overtime.index')->with('success', trans('message.delete_success'));
    }

    public function statistical()
    {
         // statistical overtimes of month
        $overtimes = Overtime::select(DB::raw('sum(hours) as sum_hours, date'))
                     ->where('user_id', Auth::user()->id)
                     ->whereMonth('date', Carbon::now()->format('m'))
                     ->whereYear('date', Carbon::now()->format('Y'));
        $sumHour = $overtimes->sum('hours');
        $overtimes = $overtimes->groupBy('date')->paginate(config('app.pagination'));
        $data = [
            'overtimes' => $overtimes,
            'sumHour' => $sumHour,
        ];
        return view("employees.overtime.statistic",  $data);
    }
}
