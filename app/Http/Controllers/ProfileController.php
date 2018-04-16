<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{

    public function index()
    {
        return redirect('/');
    }

    public function create()
    {
        return redirect('/');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return redirect('/');
    }

    public function edit($id)
    {
        return redirect('/');
    }
	
    public function resetPass()
    {
        return view('panel.profile.reset-password');
    }
	
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
		$user->password = bcrypt($request->password);
		$user->save();
		
		return redirect('/')->with('update', 'password');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
