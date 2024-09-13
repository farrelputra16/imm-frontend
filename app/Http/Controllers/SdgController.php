<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use Illuminate\Http\Request;

class SdgController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sdgs = Sdg::all();
        return view('sdgs.index', compact('sdgs'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sdgs.create');
    }

    public function view($id)
    {
        $sdg = Sdg::findOrFail($id);
        return view('sdgs.view', compact('sdg'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Sdg::create($request->all());

        return redirect()->route('sdgs.index')
            ->with('success', 'SDG created successfully.');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Sdg  $sdg
     * @return \Illuminate\Http\Response
     */
    public function show(Sdg $sdg)
    {
        return view('sdgs.show', compact('sdg'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Sdg  $sdg
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sdg = Sdg::findOrFail($id);
        return view('sdgs.edit', compact('sdg'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sdg  $sdg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sdg = Sdg::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $sdg->update($request->all());

        return redirect()->route('sdgs.index')->with('success', 'SDG updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Sdg  $sdg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sdg $sdg)
    {
        $sdg->delete();

        return redirect()->route('sdgs.index')
            ->with('success', 'SDG deleted successfully.');
    }
}
