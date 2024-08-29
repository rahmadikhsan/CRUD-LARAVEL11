<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $foods = Food::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.foods.indexFood', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Created Food';
        $categories = Category::all();

        return view('admin.foods.formFood', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $imageFood = null;

        if ($request->imageFood) {
            $imageFood = time().'.'.$request->file('imageFood')->extension();
            $request->imageFood->storeAs('public/foods', $imageFood);
        }
        Food::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => str_replace('.', '', $request->price),
            'description' => $request->description,
            'image' => $imageFood,
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Food created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        $title = 'Edit food'.$food->name;
        $categories = Category::all();

        return view('admin.foods.editFood', compact('title', 'food', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);
        $imageFood = null;
        if ($request->imageFood) {
            $imageFood = time().'.'.$request->file('imageFood')->extension();
            $request->imageFood->storeAs('public/foods', $imageFood);

            $path = storage_path('app/public/foods/'.$food->image);
            if (File::exists($path)) {
                // code...
                File::delete($path);
            }
            $food->image = $imageFood;
        }

        $food->name = $request->name;
        $food->slug = Str::slug($request->name);
        $food->price = str_replace('.', '', $request->price);
        $food->description = $request->description;

        $food->update();

        return redirect()->back()->with('success', 'Food updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        try {

            //code...
            $path = storage_path('app/public/foods/'.$food->image);
            if (File::exists($path)) {
                // code...
                File::delete($path);
            }
            $food->deleteOrFail();

            return redirect()->back()->with('success', 'Food deleted');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
