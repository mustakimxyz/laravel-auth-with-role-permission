<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    const EMPLOYEE_INDEX = 'employee/';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUser = Employee::all();
        return Inertia::render('Employee/Index', [
            'status' => session('status'),
            'allUser' => $allUser,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Employee/Create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'age' => 'required|integer|max:255',
            'start_date' => 'required|string|max:255',
        ]);

        Employee::create([
            'name' => $request->name,
            'position' => $request->position,
            'office' => $request->office,
            'age' => $request->age,
            'start_date' => $request->start_date,
        ]);

        return redirect(self::EMPLOYEE_INDEX);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::whereId($id)->first();
        return Inertia::render('Employee/Edit', [
            'status' => session('status'),
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'age' => 'required|integer|max:255',
            'start_date' => 'required|string|max:255',
        ]);
        $employee = Employee::whereId($id)->first();

        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->office = $request->office;
        $employee->age = $request->age;
        $employee->start_date = $request->start_date;
        $employee->update();

        return redirect(self::EMPLOYEE_INDEX);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        \Log::info($id);
        Employee::destroy($id);
    }
}
