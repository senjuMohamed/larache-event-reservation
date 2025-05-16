<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\RequestLibrary;

class BlogController extends Controller
{
    public function index()
    {
        $requestLibrary = new RequestLibrary();
        $posts = $requestLibrary->getData('posts', 'post');

        return view('blog.index', ['posts' => $posts['data']]);
    }
}
