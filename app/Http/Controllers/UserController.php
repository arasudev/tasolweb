<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('team')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view('user.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->only(['name', 'email', 'phone', 'gender']);
        $input['team_id'] = $request->team;
        $input['breakfast'] = isset($request->food['breakfast']) ? true : false;
        $input['lunch'] = isset($request->food['lunch']) ? true : false;
        $randomPassword = random_int(10, 12);
        $input['password'] = Hash::make($randomPassword);
        User::create($input);
        return redirect('/users')->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $teams = Team::all();
        return view('user.edit', compact('user', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect!');
            }
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->back()->with('success', 'Password changed successfully!');
        }
        $input = $request->only(['name', 'email', 'phone', 'gender']);
        $input['team_id'] = $request->team;
        $input['breakfast'] = isset($request->food['breakfast']) ? true : false;
        $input['lunch'] = isset($request->food['lunch']) ? true : false;
        $user->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['action' => 'success', 'message' => 'Post deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete post'], 500);
        }
    }

    public function getContacts()
    {
        $users = User::all();
        return view('user.contacts', compact('users'));
    }
}
