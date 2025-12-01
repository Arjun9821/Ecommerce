<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $request->validate(['name'=>'required|string|max:255']);
        Category::create($request->only('name'));
        return redirect()->route('admin.categories.index')->with('success','Category created.');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $request->validate(['name'=>'required|string|max:255']);
        $category->update($request->only('name'));
        return redirect()->route('admin.categories.index')->with('success','Category updated.');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success','Category deleted.');
    }
}
