<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use Illuminate\Http\Request;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $financialYear = FinancialYear::latest()->get();
        return view('finan.index', ['finance_year' => $financialYear]);
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
        FinancialYear::create($request->all());
        return back()->with('success', 'Financial Year Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinancialYear  $financialYear
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialYear $financialYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialYear  $financialYear
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialYear $financialYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinancialYear  $financialYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $financialYear)
    {
        //
        FinancialYear::whereId($financialYear)->update($request->except('_token', '_method'));

        return back()->with('success', 'Financial Year Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinancialYear  $financialYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialYear $financialYear)
    {
        //
        $financialYear->delete();
        return back()->with('success', 'Financial Year Deleted');
    }
}