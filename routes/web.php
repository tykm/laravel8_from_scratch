<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    $posts = collect(File::files(resource_path("posts")))
        ->map(function ($file) {
            $document = YamlFrontMatter::parseFile($file);

            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        });

    return view("posts", [
        "posts" => $posts
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
