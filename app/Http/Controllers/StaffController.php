<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Inertia\Inertia;



class StaffController extends Controller
{
    
    public function index()
    {
        $staff = Staff::latest()->get();
        return Inertia::render('Staff/Index', compact('staff'));
    }

    public function toggleStatus($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->update(['active' => 0]);

        return response()->json([
            'message' => 'Staff status updated',
            'data' => $staff
        ]);
    }

    public function create()
    {
        $staff = Staff::where('active', 1)->get();

        return Inertia::render('Staff/Create', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'counter_number' => 'required|string|max:10|unique:staff,counter_number',
        ]);

        Staff::create([
            'name' => $request->name,
            'counter_number' => $request->counter_number,
            'active' => 1,
        ]);

        return redirect()->route('staff.index')->with('message', 'Staff created successfully.');
    }

    // public function edit($id)
    // {
    //     $staff = Staff::findOrFail($id);
    //     return Inertia::render('Staff/Edit', compact('staff'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $staff = Staff::findOrFail($id);
    //     $staff->update([
    //         'name' => $request->name,
    //         'counter_number' => $request->counter_number,
    //     ]);

    //     return redirect()->route('staff.index')->with('message', 'Staff updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $staff = Staff::findOrFail($id);
    //     $staff->active = 0;

    //     return redirect()->route('staff.index')->with('message', 'Staff deleted successfully.');
    // }
}
