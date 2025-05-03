<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\BloodInventory;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_donors' => Donor::count(),
            'total_donations' => Donation::count(),
            'total_inventory' => BloodInventory::sum('quantity'),
            'recent_donations' => Donation::with('donor')
                ->latest()
                ->take(5)
                ->get(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats
        ]);
    }
} 