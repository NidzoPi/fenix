<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class OrganizationsController extends Controller
{
   public function index($user)
    {
    	$user = User::findOrFail($user);

        return view('profiles.index', [
        	'user' => $user,
        ]);
    }
}
