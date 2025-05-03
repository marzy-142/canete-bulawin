<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\BloodInventory;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['donor.user'])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('donor.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return inertia('Donations/Index', [
            'donations' => $donations,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        $donors = Donor::with('user')->get();
        return inertia('Donations/CreateEditForm', [
            'donors' => $donors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'donation_date' => 'required|date',
            'quantity_ml' => 'required|integer|min:450|max:500', // Standard donation is 450-500ml
            'status' => 'required|in:pending,approved,rejected',
        ]);

        DB::transaction(function () use ($request) {
            $donation = Donation::create($request->all());

            if ($request->status === 'approved') {
                BloodInventory::create([
                    'blood_type' => $donation->donor->blood_type,
                    'quantity_ml' => $request->quantity_ml,
                    'expiry_date' => now()->addDays(42), // Blood expires after 42 days
                    'status' => 'available',
                    'donation_id' => $donation->id,
                ]);
            }
        });

        return redirect()->route('donations.index')
            ->with('success', 'Donation recorded successfully.');
    }

    public function edit(Donation $donation)
    {
        $donors = Donor::with('user')->get();
        return inertia('Donations/CreateEditForm', [
            'donation' => $donation->load('donor.user'),
            'donors' => $donors,
        ]);
    }

    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'donation_date' => 'required|date',
            'quantity_ml' => 'required|integer|min:450|max:500',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        DB::transaction(function () use ($request, $donation) {
            $donation->update($request->all());

            if ($request->status === 'approved' && !$donation->bloodInventory) {
                BloodInventory::create([
                    'blood_type' => $donation->donor->blood_type,
                    'quantity_ml' => $request->quantity_ml,
                    'expiry_date' => now()->addDays(42),
                    'status' => 'available',
                    'donation_id' => $donation->id,
                ]);
            }
        });

        return redirect()->route('donations.index')
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        DB::transaction(function () use ($donation) {
            if ($donation->bloodInventory) {
                $donation->bloodInventory->delete();
            }
            $donation->delete();
        });

        return redirect()->route('donations.index')
            ->with('success', 'Donation deleted successfully.');
    }
}