<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function create()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $user->image = $filePath;
            $user->save();
        }

        Auth::login($user);
        return redirect()->route('users.index');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => "Email yoki parol noto'g'ri"])
                ->withInput($request->only('email'));
        }

        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();

        return redirect()->route('users.index');
    }

    public function handleLogin()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('handleLogin');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($request->has('delete') && $request->delete) {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);  
        }

        $user->delete();  
        Auth::logout(); 
        return redirect()->route('handleLogin');  
    }

    $data = $request->except('delete');  

    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']); 
    } else {
        unset($data['password']); 
    }

  
    if ($request->hasFile('image')) {
        if ($user->image) {
            Storage::disk('public')->delete($user->image); 
        }
        $data['image'] = $request->file('image')->store('images', 'public'); 
    }


    $user->update($data);

    return redirect()->route('users.index'); 
}


    public function destroy(string $id)
    {
       
}
}