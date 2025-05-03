<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $donor = $user->donor;
        
        $stats = [
            'total_donations' => Donation::where('donor_id', $donor->id)->count(),
            'last_donation' => Donation::where('donor_id', $donor->id)
                ->latest()
                ->first(),
            'next_eligible_date' => $donor->next_eligible_date,
        ];

        return Inertia::render('Donor/Dashboard', [
            'stats' => $stats
        ]);
    }
} 