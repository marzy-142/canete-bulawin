<?php

namespace App\Http\Controllers;

use App\Models\BloodInventory;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BloodInventoryController extends Controller
{
    public function index(Request $request)
    {
        $inventory = BloodInventory::with('donation')
            ->when($request->search, function ($query, $search) {
                $query->where('blood_type', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return inertia('BloodInventory/Index', [
            'inventory' => $inventory,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        $donations = Donation::where('status', 'approved')
            ->whereDoesntHave('bloodInventory')
            ->with('donor')
            ->get();

        return inertia('BloodInventory/CreateEditForm', [
            'donations' => $donations,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity_ml' => 'required|integer|min:450|max:500',
            'expiry_date' => 'required|date|after:today',
            'status' => 'required|in:available,used,expired',
            'donation_id' => 'required|exists:donations,id',
        ]);

        DB::transaction(function () use ($request) {
            BloodInventory::create($request->all());
        });

        return redirect()->route('blood-inventory.index')
            ->with('success', 'Blood unit added successfully.');
    }

    public function edit(BloodInventory $unit)
    {
        $donations = Donation::where('status', 'approved')
            ->whereDoesntHave('bloodInventory')
            ->orWhere('id', $unit->donation_id)
            ->with('donor')
            ->get();

        return inertia('BloodInventory/CreateEditForm', [
            'unit' => $unit->load('donation'),
            'donations' => $donations,
        ]);
    }

    public function update(Request $request, BloodInventory $unit)
    {
        $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity_ml' => 'required|integer|min:450|max:500',
            'expiry_date' => 'required|date|after:today',
            'status' => 'required|in:available,used,expired',
            'donation_id' => 'required|exists:donations,id',
        ]);

        DB::transaction(function () use ($request, $unit) {
            $unit->update($request->all());
        });

        return redirect()->route('blood-inventory.index')
            ->with('success', 'Blood unit updated successfully.');
    }

    public function destroy(BloodInventory $unit)
    {
        $unit->delete();

        return redirect()->route('blood-inventory.index')
            ->with('success', 'Blood unit deleted successfully.');
    }
}