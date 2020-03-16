<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Categories;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PostsControllers extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:ROLE_ADMIN');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::paginate(10);
        //For filter
        $categories = Categories::all();
        return view('posts.list', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('posts.create', compact('categories'));
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
        $post->category_id = request('category_id');

        if (request('image')) {
            $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $post->user_id_created = Auth::user()->id;
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
        $categories = Categories::all();
        // $this->authorize($post, 'update');
        return view('posts.edit', compact('post', 'categories'));
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
        $post->category_id = request('category_id');

        if ($request->hasFile('image')) {
            $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $post->user_id_updated = Auth::user()->id;
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
        return redirect()->route('posts.trash')->with('success', "Post $post->title restored!");
    }

    public function restoreAll()
    {
        $post = Posts::onlyTrashed()->get();
        if (count($post) == 0) {
            return redirect()->route('posts.trash')->with('delete', "Clean trash, nothing to restore!");
        } else {
            Posts::onlyTrashed()->restore();
            return redirect()->route('posts.trash')->with('delete', "All data restored!");
        }
    }

    public function delete($id)
    {
        $post = Posts::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('posts.trash')->with('delete', "Post $post->title deleted forever!");
    }

    public function deleteAll()
    {
        $post = Posts::onlyTrashed()->get();

        if (count($post) == 0) {
            return redirect()->route('posts.trash')->with('delete', "Clean trash, nothing to delete!");
        } else {
            Posts::onlyTrashed()->forceDelete();
            return redirect()->route('posts.trash')->with('delete', "All posts deleted forever!");
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

    //Search trash
    public function searchTrash(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('posts.trash');
        }
        $posts = Posts::onlyTrashed()->where('title', 'LIKE', '%' . $keyword . '%')
            ->paginate(10);
        return view('posts.trash', compact('posts'));
    }

    public function filterByCategories(Request $request)
    {
        $idCity = request('id');

        if (!empty($idCity)) {
            //kiem tra categories co ton tai khong
            $categoriesFilter = Categories::findOrFail($idCity);

            //lay ra tat ca posts cua categoriesFilter
            $posts = Posts::where('category_id', $categoriesFilter->id)->paginate(10);
            $totalPostsFilter = count($posts);
            $categories = Categories::all();

            return view('posts.list', compact('categories', 'posts', 'totalPostsFilter', 'categoriesFilter'));
        }
        return redirect()->route('posts.index');
    }
}