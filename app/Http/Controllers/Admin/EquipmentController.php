<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    /**
     * Display equipment management page
     */
    public function index()
    {
        // Clear equipment notification for the admin
        \App\Models\Notification::clearCount(auth()->id(), 'equipment');

        $equipment = Equipment::with(['rentals' => function($query) {
            $query->where('status', 'active');
        }])->latest()->paginate(10);
        
        $availableCount = Equipment::where('status', 'available')->count();
        $rentedCount = Equipment::where('status', 'rented')->count();
        $totalRevenue = Rental::where('status', 'completed')->sum('total_price');
        
        return view('admin.equipment.index', compact('equipment', 'availableCount', 'rentedCount', 'totalRevenue'));
    }

    /**
     * Show form to create new equipment
     */
    public function create()
    {
        return view('admin.equipment.create');
    }

    /**
     * Store new equipment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rental_price_per_month' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('equipment', 'public');
        }

        Equipment::create($validated);

        // Increment equipment notification for all admin users
        $adminUsers = User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'equipment');
        }

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Equipment added successfully!');
    }

    /**
     * Show form to edit equipment
     */
    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    /**
     * Update equipment
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rental_price_per_month' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $validated['image'] = $request->file('image')->store('equipment', 'public');
        }

        $equipment->update($validated);

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Equipment updated successfully!');
    }

    /**
     * Delete equipment
     */
    public function destroy(Equipment $equipment)
    {
        // Delete image if exists
        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return redirect()->route('admin.equipment.index')
            ->with('success', 'Equipment deleted successfully!');
    }

    /**
     * Show reports with graphs
     */
    public function reports()
    {
        // Get rental statistics
        $monthlyRentals = Rental::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Equipment status distribution
        $equipmentStatus = Equipment::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Top rented equipment
        $topEquipment = Equipment::withCount(['rentals' => function($query) {
            $query->where('status', 'completed');
        }])
            ->orderBy('rentals_count', 'desc')
            ->limit(5)
            ->get();

        // Revenue by month (last 6 months)
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenue = Rental::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'completed')
                ->sum('total_price');
            
            $monthlyRevenue[] = [
                'month' => $date->format('M Y'),
                'revenue' => $revenue
            ];
        }

        // Active rentals
        $activeRentals = Rental::with(['equipment', 'user'])
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('admin.equipment.reports', compact(
            'monthlyRentals',
            'equipmentStatus',
            'topEquipment',
            'monthlyRevenue',
            'activeRentals'
        ));
    }
}
