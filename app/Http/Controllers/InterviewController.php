<?php

namespace App\Http\Controllers;

use App\Interview;
use Illuminate\Http\Request;
use Auth;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interviews = Auth::user()->interviews;
        return response()->json(compact('interviews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $interview = Interview::create([
            'candidate_id' => Auth::user()->id,
            'company_name' => $request->company_name,
            'company_position' => $request->company_position,
            'current_status' => $request->current_status,
            "current_round" => $request->current_round,
            "total_rounds" => $request->total_rounds
        ]);

        return response()->json($interview);
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
        $interview = Interview::findOrFail($id)->update([
            'candidate_id' => Auth::user()->id,
            'company_name' => $request->company_name,
            'company_position' => $request->company_position,
            'current_status' => $request->current_status,
            "current_round" => $request->current_round,
            "total_rounds" => $request->total_rounds
        ]);

        return response()->json(compact('$interview'));
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
