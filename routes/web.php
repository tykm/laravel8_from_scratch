<?php

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
    return view("posts");
});

# Routes requests from "localhost/posts/slug" and loads slug.html
Route::get('posts/{post}', function($slug) {
    # Getting slug.html path
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    # Check if slug.html exists
    if (!file_exists($path)) {
        return redirect('/');
    }

    # Cache slug.html inside $post and
    $post = cache() -> remember("posts.{$slug}", 60, fn()=>file_get_contents($path));

    # Return $post containing slug.html to user
    return view("post", [
        "post" => $post
    ]);
# Regex to only accept page requests with letters, -, and _
}) -> where('post', '[A-z_\-]+');
