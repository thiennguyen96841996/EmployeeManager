<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Http\Requests\AddReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::where('user_id', Auth::user()->id)->paginate(config('app.pagination'));
        $data = [
            'reports' => $reports,
        ];
        return view("employees.report.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employees.report.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddReportRequest $request)
    {
        $reports = new Report();
        $reports->date = $request->date;
        $reports->today_content = $request->todayContent;
        $reports->tomorrow_content = $request->tomorrowContent;
        $reports->problem = $request->problem;
        $reports->user_id = Auth::user()->id;
        
        $reports->save();
        $request->session()->flash('success', trans('message.add_success'));
        return redirect()->route('report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reports = Report::findOrFail($id);
        $data = [
            'reports' => $reports,
        ];
        return view("employees.report.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reports = Report::findOrFail($id);
        $data = [
            'reports' => $reports,
        ];
        return view("employees.report.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, $id)
    {
        $reports = Report::findOrFail($id);
        $reports->today_content = $request->todayContent;
        $reports->tomorrow_content = $request->tomorrowContent;
        $reports->problem = $request->problem;
        $reports->save();
        $request->session()->flash('success', trans('message.edit_success'));
        return redirect()->route('report.index');
    }
}
