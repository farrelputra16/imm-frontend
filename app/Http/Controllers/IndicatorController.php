<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Indicator;
use Illuminate\Http\Request;


class IndicatorController extends Controller
{
    /**
     * Display a listing of the indicators.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicators = Indicator::all();
        return view('indicators.index', compact('indicators'));
    }

    /**
     * Show the form for creating a new indicator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all indicators to be used as parent indicators
        $indicators = Indicator::all();

        // Retrieve all SDGs
        $sdgs = Sdg::all();

        // Pass the retrieved data to the view
        return view('indicators.create', compact('indicators', 'sdgs'));
    }
    public function view($id)
    {
        $indicator = Indicator::findOrFail($id);
        return view('indicators.view', compact('indicator'));
    }


    /**
     * Store a newly created indicator in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:550',
            'order' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_indicator_id' => 'nullable|integer|exists:indicators,id',
            'sdg_id' => 'required|integer|exists:sdgs,id',
            'description' => 'nullable|string',
        ]);

        Indicator::create($request->all());

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator created successfully.');
    }

    /**
     * Display the specified indicator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indicator = Indicator::findOrFail($id);
        return view('indicators.show', compact('indicator'));
    }

    /**
     * Show the form for editing the specified indicator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indicator = Indicator::find($id);
        $indicators = Indicator::all(); 
        $sdgs = Sdg::all();

        return view('indicators.edit', compact('indicator', 'indicators', 'sdgs'));
    }

    /**
     * Update the specified indicator in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $indicator = Indicator::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:550',
            'order' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_indicator_id' => 'nullable|integer|exists:indicators,id',
            'sdg_id' => 'required|integer|exists:sdgs,id',
            'description' => 'nullable|string',
        ]);

        $indicator->update($request->all());

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator updated successfully.');
    }

    /**
     * Remove the specified indicator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicator = Indicator::findOrFail($id);
        $indicator->delete();

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator deleted successfully.');
    }
}
