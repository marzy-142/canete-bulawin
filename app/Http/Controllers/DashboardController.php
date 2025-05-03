<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\BloodInventory;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'donors' => Donor::count(),
            'donations' => Donation::count(),
            'inventory' => BloodInventory::sum('quantity_ml') / 450, // Convert ml to units (~1 unit = 450ml)
        ];

        return inertia('Dashboard', ['stats' => $stats]);
    }
}