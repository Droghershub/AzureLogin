<?php

/**
 * ProductController class handles product-related operations.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use League\Csv\Reader;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
     * Display a list of products based on filters.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->input("status", "all");
        $stock = $request->input("stock", "all"); // Added stock variable
        $search = $request->input("search");

        $query = Product::query();

        $query
            ->when($status !== "all", function ($query) use ($status) {
                return $query->where("status", $status);
            })
            ->when($stock !== "all", function ($query) use ($stock) {
                switch ($stock) {
                    case "low":
                        $query->where("quantity", "<", 25);
                        break;
                    case "moderate":
                        $query
                            ->where("quantity", ">=", 25)
                            ->where("quantity", "<", 100);
                        break;
                    case "high":
                        $query->where("quantity", ">=", 100);
                        break;
                }
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where("name", "like", "%" . $search . "%")
                        ->orWhere("description", "like", "%" . $search . "%");
                });
            });

        $products = $query->paginate(100);

        $brands = Brand::all();
        $categories = Category::all();

        return view(
            "products.index",
            compact("products", "brands", "categories")
        );
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "file" => "required|file|mimes:csv",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("products.index")
                ->with("failure", $validator->errors());
        }

        $csv = $request->file("file");
        $reader = Reader::createFromPath($csv->getPathname(), "r");

        $records = $reader->getRecords();

        $uploadedProducts = [];

        $isHeader = true;

        foreach ($records as $row) {
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            // Adjust the column indices based on your CSV file structure
            $purchasePrice = $this->validateDecimal($row[3]); // Assuming purchase_price is in the 5th column (index 4)
            $retailPrice = $this->validateDecimal($row[4]); // Assuming retail_price is in the 6th column (index 5)
            $currentPrice = $this->validateDecimal($row[5]);
            $quantity = $row[6];

            // Check if any of the decimal values failed validation
            if (
                $purchasePrice === null ||
                $retailPrice === null ||
                $currentPrice === null ||
                $quantity === null
            ) {
                // Log an error or handle it based on your application's requirements
                continue; // Skip this row and move to the next one
            }

            // Check if the brand already exists, or create a new one

            $brand = Brand::where("name", $row[7])->first();

            if (!$brand) {
                $brand = Brand::create([
                    "contact_id" => 1,
                    "name" => $row[7],
                    "photo" => "placeholder.png",
                ]);
            }

            $category = Category::where("name", $row[8])->first();

            if ($category) {
                $modelData = [
                    "name" => $row[0],
                    "photo" => "placeholder.png",
                    "variant" => $row[1],
                    "unit" => $row[2],
                    "purchase_price" => $purchasePrice,
                    "retail_price" => $retailPrice,
                    "current_price" => $currentPrice,
                    "quantity" => $quantity,
                    "brand_id" => $brand->id,
                    "category_id" => $category->id,
                ];
                $uploadedProducts[] = $modelData;
            }
        }

        // Batch insert the products
        Product::insert($uploadedProducts);

        return redirect()->back();
    }

    private function validateDecimal($value)
    {
        $trimmedValue = trim($value);

        // Ensure that the trimmed value is numeric
        return is_numeric($trimmedValue) ? $trimmedValue : null;
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $brands = Brand::all(); // Assuming you have a Brand model

        $categories = Category::all();

        return view("products.create", compact("brands", "categories"));
    }

    /**
     * Store a newly created product in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "brand_id" => "nullable|string|max:255",
            "category_id" => "nullable|string|max:255",
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "variant" => "nullable|string|max:255",
            "unit" => "nullable|string|max:255",
            "purchase_price" => "required|numeric|between:0.00,9999999.99",
            "retail_price" => "required|numeric|between:0.00,9999999.99",
            "current_price" => "required|numeric|between:0.00,9999999.99",
            "quantity" => "required|integer",
            "status" => "string|in:ACTIVE,INACTIVE",
            "photo" => "required|image|mimes:png|max:2048|dimensions:ratio=1/1",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("products.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = null;
        if ($request->hasFile("photo")) {
            $photoPath = $request->file("photo")->store("products", "public");
        }

        Product::create([
            "brand_id" => $request->input("brand_id"),
            "category_id" => $request->input("category_id"),
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "variant" => $request->input("variant"),
            "unit" => $request->input("unit"),
            "purchase_price" => $request->input("purchase_price"),
            "retail_price" => $request->input("retail_price"),
            "current_price" => $request->input("current_price"),
            "quantity" => $request->input("quantity"),
            "status" => $request->input("status"),
            "photo" => $photoPath,
        ]);

        return redirect()
            ->route("products.index")
            ->with("success", "Product created successfully!");
    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view("products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::find($id);

        $brands = Brand::all();

        $categories = Category::all();
        // Pass the data to the view
        return view(
            "products.edit",
            compact("product", "brands", "categories")
        );
    }

    /**
     * Update the specified product in the database.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            "brand_id" => "nullable|string|max:255",
            "category_id" => "nullable|string|max:255",
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "variant" => "nullable|string|max:255",
            "unit" => "nullable|string|max:255",
            "purchase_price" => "required|numeric|between:0.00,9999999.99",
            "retail_price" => "required|numeric|between:0.00,9999999.99",
            "current_price" => "required|numeric|between:0.00,9999999.99",
            "quantity" => "required|integer",
            "status" => "string|max:255",
            "photo" => "required|image|mimes:png|max:2048|dimensions:ratio=1/1",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("products.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = $product->photo;
        if ($request->hasFile("photo")) {
            Storage::disk("public")->delete($product->photo);
            $photoPath = $request->file("photo")->store("products", "public");
            $product->photo = $photoPath;
        }

        $product->brand_id = $request->input("brand_id");
        $product->category_id = $request->input("category_id");
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->variant = $request->input("variant");
        $product->unit = $request->input("unit");
        $product->purchase_price = $request->input("purchase_price");
        $product->retail_price = $request->input("retail_price");
        $product->current_price = $request->input("current_price");
        $product->quantity = $request->input("quantity");
        $product->status = $request->input("status");
        $product->photo = $photoPath;

        return redirect()
            ->route("products.index")
            ->with("success", "Product updated successfully!");
    }

    /**
     * Remove the specified product from the database.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route("products.index")
            ->with("success", "Product deleted successfully!");
    }
}
