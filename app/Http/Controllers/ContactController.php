<?php

/**
 * ContactController class handles contact-related operations.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
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
     * Display a listing of contacts based on filters.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->input("status", "all");
        $search = $request->input("search");

        $query = Contact::query();

        $query
            ->when($status !== "all", function ($query) use ($status) {
                return $query->where("status", $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where("name", "like", "%" . $search . "%")
                        ->orWhere("email", "like", "%" . $search . "%")
                        ->orWhere("phone", "like", "%" . $search . "%");
                });
            });

        $contacts = $query->paginate(100);

        return view("contacts.index", compact("contacts"));
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("contacts.create");
    }

    /**
     * Store a newly created contact in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "phone" => "nullable|string|max:10",
            "email" => "nullable|email|max:255",
            "photo" =>
                "required|image|mimes:jpeg,jpg|max:2048|dimensions:ratio=1/1",
            "website" => "nullable|url|max:255",
            "status" => "string|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("contacts.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = null;
        if ($request->hasFile("photo")) {
            $photoPath = $request->file("photo")->store("contacts", "public");
        }

        Contact::create([
            "name" => $request->input("name"),
            "photo" => $photoPath, // Assuming $photoPath is already defined
            "description" => $request->input("description"),
            "phone" => $request->input("phone"),
            "email" => $request->input("email"),
            "website" => $request->input("website"),
            // Add other fields as needed
        ]);

        return redirect()
            ->route("contacts.index")
            ->with("success", "Contact added successfully!");
    }

    /**
     * Display the specified contact.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Contact $contact)
    {
        return view("contacts.show", compact("contact"));
    }

    /**
     * Show the form for editing the specified contact.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        return view("contacts.edit", compact("contact"));
    }

    /**
     * Update the specified contact in the database.
     *
     * @param Request $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "photo" => "image|mimes:jpeg,jpg|max:2048|dimensions:ratio=1/1",
            "description" => "nullable|string",
            "phone" => "nullable|string|max:10",
            "email" => "nullable|email|max:255",
            "website" => "nullable|url|max:255",
            "status" => "string|in:ACTIVE,INACTIVE",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route("contacts.index")
                ->with("failure", $validator->errors());
        }

        $photoPath = null;
        if ($request->hasFile("photo")) {
            Storage::disk("public")->delete($contact->photo);
            $photoPath = $request->file("photo")->store("contacts", "public");
            $contact->photo = $photoPath;
        }

        $contact->name = $request->input("name");
        $contact->photo = $photoPath;
        $contact->description = $request->input("description");
        $contact->phone = $request->input("phone");
        $contact->email = $request->input("email");
        $contact->website = $request->input("website");
        $contact->status = $request->input("status");

        return redirect()
            ->route("contacts.index")
            ->with("success", "Contact updated successfully!");
    }

    /**
     * Remove the specified contact from the database.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route("contacts.index")
            ->with("success", "Contact deleted successfully!");
    }
}
