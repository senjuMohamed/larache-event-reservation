<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('your_view', ['content' => 'This is your content']);
    }
}
