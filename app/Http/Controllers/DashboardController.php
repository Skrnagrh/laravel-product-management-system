<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        return view('dashboard.index', compact('totalCategories', 'totalSuppliers', 'totalProducts', 'totalUsers'))
            ->with('success', 'Selamat Datang, $userName! Semangat kerja hari ini! 💪');
    }

}
