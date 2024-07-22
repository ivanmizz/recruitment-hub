<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

// FUNCTIONS OF THIS CONTROLLER ARE ONLY ACCESSIBLE BY THE SYSTEM ADMIN

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate the search query
        $request->validate([
            'query' => 'required|min:2'
        ]);
        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('usertype', 'LIKE', "%$query%")
            ->paginate(10);

        return view('admin.users', compact('users', 'query'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', Rule::in(['cnd', 'rec', 'adm'])],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        $user->save();

        return redirect()->back()->with('success', 'User added succesfully');
    }

    public function edit(User $user)
    {
        $users = User::with('usertype');
        return view('admin.users', compact('users', 'usertype'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', Rule::in(['cnd', 'rec', 'adm'])],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User roles changed succesfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
