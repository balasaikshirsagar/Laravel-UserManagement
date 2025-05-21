<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'hobbies'])->paginate(10); // Changed from get() to paginate()
        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        $hobbies = Hobby::all();
        return view('users.create', compact('roles', 'hobbies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female,other',
            'role_id' => 'required|exists:roles,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'exists:hobbies,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
            'gender' => $validated['gender'],
            'role_id' => $validated['role_id'],
        ]);

        $user->hobbies()->attach($validated['hobbies']);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'User created successfully']);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        $user->load(['role', 'hobbies']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $hobbies = Hobby::all();
        $user->load('hobbies');
        return view('users.edit', compact('user', 'roles', 'hobbies'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'role_id' => 'required|exists:roles,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'exists:hobbies,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'gender' => $validated['gender'],
            'role_id' => $validated['role_id'],
        ]);

        $user->hobbies()->sync($validated['hobbies']);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'User updated successfully']);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->hobbies()->detach();
        $user->delete();

        return response()->json(['success' => true]);
    }

    public function changePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Password changed successfully']);
        }

        return redirect()->route('users.index')->with('success', 'Password changed successfully');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportPdf()
    {
        $users = User::with(['role', 'hobbies'])->get();
        $pdf = Pdf::loadView('exports.users-pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}