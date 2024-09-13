<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\Tag;
use App\Models\Indicator;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    public function index()
    {
        $metrics = Metric::with('tags', 'indicators')->get();
        return view('metrics.index', compact('metrics'));
    }
    
    public function create()
    {
        $tags = Tag::all();
        $indicators = Indicator::all();

        return view('metrics.create', compact('tags', 'indicators'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validated();
        $metric = Metric::create($validatedData);

        $metric->tags()->attach($request->input('tag_ids'));
        $metric->indicators()->attach($request->input('indicator_ids'));

        return redirect()->route('metrics.index')->with('success', 'Metric created successfully');
    }

    public function view($id)
{
    $metric = Metric::with('tags', 'indicators')->findOrFail($id);
    return view('metrics.view', compact('metric'));
}


    public function edit($id)
{
    $metric = Metric::with('tags', 'indicators')->findOrFail($id);
    $tags = Tag::all();
    $indicators = Indicator::all();

    return view('metrics.edit', compact('metric', 'tags', 'indicators'));
}


    public function update(Request $request, $id)
    {
        $metric = Metric::findOrFail($id);
        $metric->update($request->validated());

        $metric->tags()->sync($request->input('tag_ids', []));
        $metric->indicators()->sync($request->input('indicator_ids', []));

        return redirect()->route('metrics.index')->with('success', 'Metric updated successfully');
    }

    public function destroy($id)
    {
        Metric::destroy($id);
        return redirect()->route('metrics.index')->with('success', 'Metric deleted successfully');
    }
}
