<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use App\User;

class Users extends Controller
{
     /**
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::find(Auth::id());
        return view('layouts.showuser_details')->with(['user' => $user]);
    }

     /**
     * Show the form for editing the user data.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('auth.register')->with(['user' => $user]);
    }

    /**
     * Update the user data in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if($user->email != $request->email){
            $this->validate($request, [
                'email' => 'required|email|max:255|unique:users',
            ]);
        }

        if($request->password != null){
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }

        $ok = 'Perfil editado con éxito';
        $error = 'Error al editar el perfil';

        if ($user->save()){
            Auth::login($user);
            return view('layouts.showuser_details')->with(['ok' => $ok, 'user' => $user]);
        }
        else {
            return view('layouts.showuser_details')->with(['error' => $error, 'user' => $user]);
        }
    }

    /**
     * Delete the user from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {
        $user = User::find(Auth::id());
        $user->delete();
        return redirect('/');
    }
}
