<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // display dashboard page
    public function create(Request $request)
    {
        $totalSales = Order::sum('total_price');
        $totalSalesQty = Order::sum('total_qty');
        $orders = Order::with('orderItems')->get();
        // dd($orders);
        return view('backend.dashboard', compact('totalSales', 'totalSalesQty', 'orders'));
    }
}
