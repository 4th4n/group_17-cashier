<?php

// app/Http/Controllers/CashierController.php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    // Display Cashier Dashboard
    public function index()
    {
        $orders = Order::where('status', 'pending')->get(); // Get all pending orders
        $totalAmount = $orders->sum('total_amount'); // Calculate the total amount

        return view('cashier.index', compact('orders', 'totalAmount'));
    }

    // Mark the order as completed
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed'; // Change status to 'completed'
        $order->save();

        return redirect()->route('cashier.index')->with('success', 'Order completed successfully.');
    }

    // Cancel the order
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled'; // Change status to 'cancelled'
        $order->save();

        return redirect()->route('cashier.index')->with('success', 'Order cancelled successfully.');
    }
    
}
