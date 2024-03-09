<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;

class BannerController extends Controller
{
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

    public function index()
    {
        $banners = Banner::all();
        return view("banners.index", compact("banners"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "payload" => "required|string",
            "photo" =>
                "required|image|mimes:jpeg,jpg|max:10240|dimensions:ratio=2/1",
            "size" => "required|in:S,M,L",
            "status" => "required|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("banners.index")
                ->with("failure", $validator->errors());
        }

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile("photo")) {
            $photoPath = $request->file("photo")->store("banners", "public");
        }

        Banner::create([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "payload" => $request->input("payload"),
            "photo" => $photoPath,
            "size" => $request->input("size"),
            "status" => $request->input("status"),
        ]);

        return redirect()
            ->route("banners.index")
            ->with("success", "Banner created successfully.");
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "payload" => "required|string",
            "photo" => "image|mimes:jpeg,jpg|max:10240|dimensions:ratio=2/1",
            "size" => "required|in:S,M,L",
            "status" => "required|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("banners.index")
                ->with("failure", $validator->errors());
        }

        $banner = Banner::findOrFail($id);

        // Handle photo upload
        if ($request->hasFile("photo")) {
            $photoPath = $request->file("photo")->store("banners", "public");
            $banner->photo = $photoPath;
        }

        $banner->name = $request->input("name");
        $banner->description = $request->input("description");
        $banner->payload = $request->input("payload");
        $banner->size = $request->input("size");
        $banner->status = $request->input("status");
        $banner->save();

        return redirect()
            ->route("banners.index")
            ->with("success", "Banner updated successfully.");
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()
            ->route("banners.index")
            ->with("success", "Banner deleted successfully.");
    }
}
