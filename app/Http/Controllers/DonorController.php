<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = Donor::with('user')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });

        $donors = $query->paginate(10);

        return inertia('Donors/Index', [
            'donors' => $donors,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return inertia('Donors/CreateEditForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $donor = Donor::create([
            'user_id' => $user->id,
            'blood_type' => $request->blood_type,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('donors.index')
            ->with('success', 'Donor registered successfully.');
    }

    public function edit(Donor $donor)
    {
        return inertia('Donors/CreateEditForm', [
            'donor' => $donor->load('user'),
        ]);
    }

    public function update(Request $request, Donor $donor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $donor->user_id,
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $donor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $donor->update([
            'blood_type' => $request->blood_type,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('donors.index')
            ->with('success', 'Donor updated successfully.');
    }

    public function destroy(Donor $donor)
    {
        $donor->user->delete();
        $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Donor deleted successfully.');
    }
}