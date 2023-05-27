<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin', 'permission:view-customer|edit-customer|update-customer|delete-customer|accept-customer|reject-customer']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUser = User::role('customer')->with('roles')->get();
        // \Log::info($allUser);
        return Inertia::render('Dashboard', [
            'status' => session('status'),
            'allUser' => $allUser,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('User/Create');
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
            'avatar' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'age' => 'required|integer|max:255',
            'start_date' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'role' => $request->role,
            'age' => $request->age,
            'start_date' => $request->start_date,
        ]);

        return redirect(RouteServiceProvider::ADMIN_HOME);
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
        $user = User::whereId($id)->first();
        return Inertia::render('User/Edit', [
            'status' => session('status'),
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string|max:255',
        ]);

        \Log::info(" request ".  json_encode($request->all()));

        $user = User::whereId($id)->first();

        if ($request->image) {
            \Log::info('here');
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/image'), $filename);
            $imagePath = 'uploads/image/' . $filename;
            $user->avatar = $imagePath;
        }

        $user->name = $request->name;
        $user->approval_status = $request->approval_status;

        $user->update();

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        User::destroy($id);
    }
}
