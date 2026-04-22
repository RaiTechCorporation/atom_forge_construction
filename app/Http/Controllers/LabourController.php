<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Http\Requests\StoreLabourRequest;
use App\Http\Requests\UpdateLabourRequest;
use Illuminate\Http\Request;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labours = Labour::latest()->paginate(15);
        return view('labour.index', compact('labours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labour = new Labour();
        return view('labour.create', compact('labour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabourRequest $request)
    {
        Labour::create($request->validated());

        return redirect()->route('labour.index')
            ->with('success', 'Labour record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Labour $labour)
    {
        $labour->load('attendances.project');
        return view('labour.show', compact('labour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Labour $labour)
    {
        return view('labour.edit', compact('labour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabourRequest $request, Labour $labour)
    {
        $labour->update($request->validated());

        return redirect()->route('labour.index')
            ->with('success', 'Labour record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Labour $labour)
    {
        $labour->delete();

        return redirect()->route('labour.index')
            ->with('success', 'Labour record deleted successfully.');
    }
}
