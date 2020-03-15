<?php

namespace App\Http\Controllers;

use App\Posts;
use http\Env\Response;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsRequest;
use DB;
use Illuminate\Support\Facades\Redirect;

class PostsControllers extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::paginate(10);
        return view('posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $post = new Posts();
        $post->title = request('title');
        $post->content = request('content');

        if ($post->image) {
            $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', "New Post $post->title created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::withTrashed()->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::withTrashed()->findOrFail($id);
        // $this->authorize($post, 'update');
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $post = Posts::withTrashed()->findOrFail($id);
        $post->title = request('title');
        $post->content = request('content');

        if ($request->hasFile('image')) {
            $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', "Update Post $post->title success!");
    }

    /**
     * Remove the specified resource from storage.
     * Move to trash
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('delete', "Post $post->title deleted!");
    }

    public function trashed(Request $request)
    {
        $posts = Posts::onlyTrashed()->paginate(10);
        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Posts::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trashed')->with('success', "Post $post->title restored!");
    }

    public function restoreAll()
    {
        $post = Posts::onlyTrashed()->get();
        if (count($post) == 0) {
            return redirect()->route('posts.trashed')->with('delete', "Clean trash, nothing to restore!");
        } else {
            Posts::onlyTrashed()->restore();
            return redirect()->route('posts.trashed')->with('delete', "All data restored!");
        }
    }

    public function delete($id)
    {
        $post = Posts::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('posts.trashed')->with('delete', "Post $post->title deleted forever!");
    }

    public function deleteAll()
    {
        $post = Posts::onlyTrashed()->get();

        if (count($post) == 0) {
            return redirect()->route('posts.trashed')->with('delete', "Clean trash, nothing to delete!");
        } else {
            Posts::onlyTrashed()->forceDelete();
            return redirect()->route('posts.trashed')->with('delete', "All posts deleted forever!");
        }
    }

    //Search
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('posts.index');
        }
        $posts = Posts::where('title', 'LIKE', '%' . $keyword . '%')
            ->paginate(10);
        return view('posts.list', compact('posts'));
    }
}