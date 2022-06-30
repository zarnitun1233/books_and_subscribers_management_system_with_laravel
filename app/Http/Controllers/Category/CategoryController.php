<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show Category List
     */
    public function index()
    {
        $categories = Category::where('deleted_at', NULL)->get();
        return view("category.index")->with('categories', $categories);
    }

    /**
     * Show Create Category Form
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Storing Category Name
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Create Category Successfully');
        }
    }

    /**
     * Show Category Edit Form
     * @param $id
     */
    public function edit($id)
    {
        $categories = Category::where('id', $id)->get();
        foreach ($categories as $category) {
            return view('category.edit')->with('category', $category);
        }
    }

    /**
     * Updating Category Data
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        DB::table('categories')
            ->where('id', $id)
            ->update(
                [
                    'name' => $request->name,
                ]
            );
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Delete Category
     * @param $id
     */
    public function delete($id)
    {
        DB::table('categories')
            ->where('id', $id)
            ->update(
                [
                    'deleted_at' => now()
                ]
            );
        return redirect()->route('category.index')->with('success', 'Category deleted Successfully');
    }
}
