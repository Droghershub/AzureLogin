<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();

        if (
            !$user ||
            !$user->hasRole("admin") ||
            !$user->hasRole("staff") ||
            $user->hasRole("accountant")
        ) {
            return redirect()
                ->route("home")
                ->with(
                    "error",
                    "Unauthorized access: Admin or Staff or Accountant role required."
                );
        }
    }

    public function index()
    {
        $products = [];
        $sales = [];
        $users = [];
        $wSearches = [];
        $tSearches = [];
    
        // Loop through the last 7 days
        for ($date = Carbon::now(); $date->gt(Carbon::now()->subDays(7)); $date->subDay()) {
            $key = $date->format('Y-m-d');
    
            // Get a single record for the most searched term on the specific date
            $wSearches[$key] = Search::whereDate('updated_at', $date)
                ->orderBy('count', 'desc')
                ->first();
    
            // Get top 10 searched terms overall
            $tSearches = Search::orderBy('count', 'desc')
                ->take(10)
                ->get();
    
            // Count user registrations, deletions, and active/inactive/banned users
            $users[$key] = [
                'registrations' => User::whereDate('created_at', $date)->count(),
                'deletions' => User::onlyTrashed()->whereDate('deleted_at', $date)->count(),
                'activeUsers' => User::whereDate('created_at', $date)->whereNull('deleted_at')->count(),
                'inactiveUsers' => User::onlyTrashed()->whereDate('created_at', $date)->count(),
                'bannedUsers' => User::onlyTrashed()->whereDate('deleted_at', $date)->count(),
            ];
    
            // Initialize values for products and sales for the current date
            $products[$key] = ['orders' => 0, 'quantity' => 0];
            $sales[$key] = ['purchase_price' => 0, 'retail_price' => 0, 'deal_price' => 0];
    
            // Process orders for the current date
            $orders = Order::whereDate("created_at", $date)->get();
    
            $products[$key]["orders"] = $orders->count();
    
            foreach ($orders as $order) {
                if ($order->details && $order->details->isNotEmpty()) {
                    $products[$key]['quantity'] += $order->details->sum('quantity');
                    $sales[$key]['purchase_price'] += $order->details->sum('purchase_price');
                    $sales[$key]['retail_price'] += $order->details->sum('retail_price');
                    $sales[$key]['deal_price'] += $order->details->sum('deal_price');
                }
            }
        }
    
        // Retrieve top searches and top searched items (replace with your logic)
        $topSearchedItems = []; // Replace with your logic to get top searched items
    
        return view('dashboard.index', compact('products', 'sales', 'users', 'wSearches', 'tSearches', 'topSearchedItems'));
    }

    public function derank($id)
    {
        $search = Search::find($id);

        if ($search) {
            $search->delete(); // Soft delete the record
        }

        return redirect()->back(); // Redirect back to the previous page
    }
}
