<?php

/**
 * CategoryController class handles category-related operations.
 */
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Constructor to ensure only admin or staff users have access.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __construct()
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole("admin") || !$user->hasRole("staff")) {
            return redirect()
                ->route("home")
                ->with(
                    "error",
                    "Unauthorized access: Admin or Staff role required."
                );
        }
    }

    /**
     * Display a listing of categories based on filters.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->input("status", "all");
        $search = $request->input("search");

        $query = Category::query();

        $query
            ->when($status !== "all", function ($query) use ($status) {
                return $query->where("status", $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                });
            });

        $categories = $query->paginate(100);

        return view("categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created category in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            'photo' => 'required|image|mimes:png|max:2048|dimensions:ratio=1/1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("categories.index")
                ->with("failure", $validator->errors());
        }
        
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('categories', 'public');
        }
        
        Category::create([
            'name' => $request->input('name'),
            'photo' => $photoPath,
            'description' => $request->input('description')
        ]);

        return redirect()
            ->route("categories.index")
            ->with("success", "Category created successfully!");
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view("categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view("categories.edit", compact("category"));
    }

    /**
     * Update the specified category in the database.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            'photo' => 'image|mimes:png|max:2048|dimensions:ratio=1/1',
            "status" => "string|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("categories.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = $category->photo;
        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($category->photo);
            $photoPath = $request->file('photo')->store('categories', 'public');
            $category->photo = $photoPath;
        }
    
        $category->name = $request->input('name');
        $category->photo = $photoPath;
        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->save();

        // Redirect back or wherever you need after the update
        return redirect()
            ->route("categories.index")
            ->with("success", "Category updated successfully");
    }

    /**
     * Remove the specified category from the database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route("categories.index")
            ->with("success", "Category deleted successfully!");
    }
}
