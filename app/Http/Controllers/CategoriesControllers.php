<?php

namespace App\Http\Controllers;

use App\Categories;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoriesControllers extends Controller
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
        $categories = Categories::paginate(10);
        return view('categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $category = new Categories();
        $category->name = request('name');
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->route('categories.index')->with('success', "New category $category->name created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::withTrashed()->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::withTrashed()->findOrFail($id);
        // $this->authorize($category, 'update');
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        $category = Categories::withTrashed()->findOrFail($id);
        $category->name = request('name');
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->route('categories.index')->with('success', "Update category $category->name success!");
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
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('delete', "Category $category->name deleted!");
    }

    public function trashed(Request $request)
    {
        $categories = Categories::onlyTrashed()->paginate(10);
        return view('categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Categories::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.trash')->with('success', "Category $category->name restored!");
    }

    public function restoreAll()
    {
        $category = Categories::onlyTrashed()->get();
        if (count($category) == 0) {
            return redirect()->route('categories.trash')->with('delete', "Clean trash, nothing to restore!");
        } else {
            Categories::onlyTrashed()->restore();
            return redirect()->route('categories.trash')->with('delete', "All data restored!");
        }
    }

    public function delete($id)
    {
        $category = Categories::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('categories.trash')->with('delete', "Category $category->name deleted forever!");
    }

    public function deleteAll()
    {
        $category = Categories::onlyTrashed()->get();

        if (count($category) == 0) {
            return redirect()->route('categories.trash')->with('delete', "Clean trash, nothing to delete!");
        } else {
            Categories::onlyTrashed()->forceDelete();
            return redirect()->route('categories.trash')->with('delete', "All posts deleted forever!");
        }
    }

    //Search
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('categories.index');
        }
        $categories = Categories::where('name', 'LIKE', '%' . $keyword . '%')
            ->paginate(10);
        return view('categories.list', compact('categories'));
    }

    //Search trash
    public function searchTrash(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('categories.trash');
        }
        $categories = Categories::onlyTrashed()->where('name', 'LIKE', '%' . $keyword . '%')
            ->paginate(10);
        return view('categories.trash', compact('categories'));
    }
}