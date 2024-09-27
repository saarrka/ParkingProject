<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        $categories = Category::all();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'company' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
        ]);

        Vehicle::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'company' => $request->company,
            'registration_number' => $request->registration_number,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $categories = Category::all();

        return view('vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'company' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return redirect()->back()->with('success', 'Vehicle edited successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function viewVehicles()
    {
        $vehicles = Vehicle::with('category')->get();
        return view('admins.view-vehicles', compact('vehicles')); // Ovde se može koristiti tvoj index view sa svim vozilima
    }
}
