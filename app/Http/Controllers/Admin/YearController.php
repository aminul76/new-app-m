<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Year; 
class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $years = Year::all();
       
        return view('backend.years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'y_title' => 'required|string|max:255',
            'y_slug' => 'required|string|max:255|unique:years',
        ]);

        Year::create($request->all());

        return redirect()->route('admin.years.index')->with('success', 'Year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        return view('backend.years.show', compact('year'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        return view('backend.years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {
        $request->validate([
            'y_title' => 'required|string|max:255',
            'y_slug' => 'required|string|max:255|unique:years,y_slug,' . $year->id,
        ]);

        $year->update($request->all());

        return redirect()->route('admin.years.index')->with('success', 'Year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        $year->delete();

        return redirect()->route('admin.years.index')->with('success', 'Year deleted successfully.');
    }
}
