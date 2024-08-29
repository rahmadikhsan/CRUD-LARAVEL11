<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.categories.indexCategories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Category';

        return view('admin.categories.formCategories', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $imageIcon = null;
        if ($request->icon) {
            $imageIcon = time().'.'.$request->file('icon')->extension();
            $request->icon->storeAs('public/categories', $imageIcon);
        }
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $imageIcon,
        ]);

        return redirect()->back()->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        $title = 'Edit Category'.$category->name;

        return view('admin.categories.editCategories', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $imageIcon = null;
        if ($request->icon) {
            $imageIcon = time().'.'.$request->file('icon')->extension();
            $request->icon->storeAs('public/categories', $imageIcon);

            $path = storage_path('app/public/categories/'.$category->icon);
            if (File::exists($path)) {
                // code...
                File::delete($path);
            }
            $category->icon = $imageIcon;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        return redirect()->back()->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        try {
            //code...
            $category->deleteOrFail();

            return redirect()->back()->with('success', 'Category deleted');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
