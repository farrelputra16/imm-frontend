<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->content = \Illuminate\Support\Str::limit(strip_tags($post->content), 100, $end='...');
            $post->img = env('APP_BACKEND_URL') . '/images/' . $post->img;
        }
        $backendUrl = env('APP_BACKEND_URL');
        $frontendUrl = env('APP_URL');
        return view('blog.blog', compact('posts','backendUrl'));
    }

    public function create()
    {

        $users = User::all();
        $currentUserId = Auth::id();

        return view('posts.create', compact('users', 'currentUserId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',

        ]);


        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        $post = Post::create([
            'title' => $request->input('title'),
            'img' => $imageName,
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'published_at' => $request->input('published_at'),
  
        ]);


        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function view($id)
    {
        $post = Post::findOrFail($id);

        $users = User::all();
        $currentUserId = Auth::id();
        return view('blog.blogarticle', compact('post', 'users', 'currentUserId'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        $currentUserId = Auth::id();

        return view('posts.edit', compact('post', 'users', 'currentUserId'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',

        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('img')) {
            if ($post->img && file_exists(public_path('images/' . $post->img))) {
                unlink(public_path('images/' . $post->img));
            }

            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $post->img = $imageName;
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->input('user_id');
        $post->published_at = $request->input('published_at');
   
        $post->save();



        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $imageName = time() . '.' . $request->imgupload->extension();
        $request->imgupload->storeAs('public/images', $imageName);

        return response()->json(['url' => asset('storage/images/' . $imageName)]);
    }

}
