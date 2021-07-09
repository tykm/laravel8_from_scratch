<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("posts", [
        "posts" => Post::all()
    ]);
});

# Routes requests from "localhost/posts/slug" and loads slug.html
Route::get('posts/{post}', function($slug) {
    # Find a post by it's slug and pass it to a view called "post"
    return view('post', [
        'post' => Post::find($slug)
    ]);

# Regex to only accept page requests with letters, -, and _
}) -> where('post', '[A-z_\-]+');
