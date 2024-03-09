<?php

/**
 * BrandController class handles brand-related operations.
 */
namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/**
 * Class BrandController
 * @package App\Http\Controllers
 */
class BrandController extends Controller
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
     * Display a listing of brands based on filters.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->input("status", "all");
        $search = $request->input("search");

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = Brand::query();

        $query
            ->when($status !== "all", function ($query) use ($status) {
                return $query->where("status", $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                    // Add more conditions as needed for brand attributes
                });
            });

        $contacts = Contact::all();

        $brands = $query->paginate(100);

        return view("brands.index", compact("brands", "contacts"));
    }

    /**
     * Show the form for creating a new brand.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $contacts = Contact::all();
        return view("brands.create", compact("contacts"));
    }

    /**
     * Store a newly created brand in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "contact_id" => "required|exists:contacts,id",
            "name" => "required|string|max:255",
            "photo" => "required|image|mimes:png|max:2048|dimensions:ratio=1/1",
            "description" => "nullable|string",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("brands.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = null;
        if ($request->hasFile("photo")) {
            $photoPath = $request->file("photo")->store("brands", "public");
        }

        Brand::create([
            "contact_id" => $request->input("contact_id"),
            "name" => $request->input("name"),
            "photo" => $photoPath,
            "description" => $request->input("description"),
        ]);

        return redirect()
            ->route("brands.index")
            ->with("success", "Brand created successfully!");
    }

    /**
     * Display the specified brand.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Brand $brand)
    {
        return view("brands.show", compact("brand"));
    }

    /**
     * Show the form for editing the specified brand.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $brand = Brand::find($id);

        $contacts = Contact::all();
        $product = Product::find($id);

        // Pass the data to the view
        return view("brands.edit", compact("brand", "contacts"));
    }

    /**
     * Update the specified brand in the database.
     *
     * @param Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            "contact_id" => "required|exists:contacts,id",
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "photo" => "image|mimes:png|max:2048|dimensions:ratio=1/1",
            "status" => "string|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("brands.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = $brand->photo;
        if ($request->hasFile("photo")) {
            Storage::disk("public")->delete($brand->photo);
            $photoPath = $request->file("photo")->store("brands", "public");
            $brand->photo = $photoPath;
        }

        $brand->contact_id = $request->input("contact_id");
        $brand->name = $request->input("name");
        $brand->photo = $photoPath;
        $brand->description = $request->input("description");
        $brand->status = $request->input("status");
        $brand->save();

        return redirect()
            ->route("brands.index")
            ->with("success", "Brand updated successfully!");
    }

    /**
     * Remove the specified brand from the database.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route("brands.index")
            ->with("success", "Brand deleted successfully!");
    }
}
