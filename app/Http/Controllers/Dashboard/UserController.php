<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Application;
use App\Document;
use App\Profile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::with('roles')->get();

        return view('dashboard.crud.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('dashboard.crud.users.create',  compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($request->activated) {
            $user->activated = 1;
        } else {
            $user->activated = 0;
        }
        $user->save();

        $user->roles()->attach($request->roles);
        // $job->locations()->attach($request->locations);
        

        return redirect('/dashboard/users')->with('message', 'Successfully created new user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();

        return view('dashboard.crud.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        if($request->password) {
            $user->password = bcrypt($request->password);
        }
        if($request->activated) {
            $user->activated = 1;
        } else {
            $user->activated = 0;
        }
        
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect('/dashboard/users')->with('message', 'This user was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Document::where('user_id', $user->id)->delete();
        Application::where('user_id', $user->id)->delete();
        
        $user->roles()->detach();
        $user->delete();

        Profile::where('id', $user->profile_id)->delete();

        return redirect('/dashboard/users')->with('message', 'User deleted!');
    }
}
