<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display all users
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('student_id', 'like', "%{$search}%");

            })
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users', 'search'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store user
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255',

            'student_id' => 'nullable|max:100|unique:users,student_id',

            'email' => 'required|email|unique:users,email',

            'phone' => 'nullable|max:20',

            'role' => 'required|in:admin,student',

            'password' => 'required|min:8|confirmed',

        ]);

        User::create([

            'name' => $request->name,

            'student_id' => $request->student_id,

            'email' => $request->email,

            'phone' => $request->phone,

            'role' => $request->role,

            'password' => Hash::make($request->password),

        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([

            'name' => 'required|max:255',

            'student_id' => 'nullable|max:100|unique:users,student_id,' . $user->id,

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'nullable|max:20',

            'role' => 'required|in:admin,student',

        ]);

        $data = [

            'name' => $request->name,

            'student_id' => $request->student_id,

            'email' => $request->email,

            'phone' => $request->phone,

            'role' => $request->role,

        ];

        if ($request->filled('password')) {

            $request->validate([

                'password' => 'min:8|confirmed',

            ]);

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::id()) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully.'
        );
    }
}