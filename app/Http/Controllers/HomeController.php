<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{

    public function users()
{
    // Paginate the users (show 10 per page)
    $users = User::paginate(10);
    return view('users', compact('users'));
}

    public function index()
    {
        return view('dashboard');
    }
}




