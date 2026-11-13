<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\ProductReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
       // $prevday = now()->subDay(1)->toDateString();

        $todaySales = Sale::query()->whereDate('created_at', $today)->sum('total');
        $todayRevenue = Sale::query()->whereDate('created_at', $today)->sum('paid');
        $todayExpenses = Expense::query()->whereDate('created_at', $today)->sum('amount');
        $dueAmount = Customer::query()->sum('total_due');
        $totalMedicines = Medicine::query()->count();
        $recentMedicines = Medicine::query()->latest('updated_at')->limit(10)->get();
        $recentSales = Sale::query()->with(['customer', 'items'])->whereDate('created_at', $today)->latest()->get();
        $returnMedicines = Medicine::query()->where('is_active', true)->orderBy('name')->get(['id', 'name', 'brand', 'stock']);
        $returnMedicineOptions = $returnMedicines->map(fn (Medicine $medicine) => [
            'id' => $medicine->id,
            'name' => $medicine->name,
            'brand' => $medicine->brand,
            'stock' => $medicine->stock,
        ])->values();
        $returnCustomers = Customer::query()->orderBy('name')->get(['id', 'name']);
        $returnCompanies = Medicine::query()
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');
        $recentProductReturns = ProductReturn::query()
            ->with('customer')
            ->latest('returned_at')
            ->latest('id')
            ->limit(20)
            ->get();
        $upcomingExpiry = $this->upcomingExpiryMedicines();

        return view('dashboard.index', compact(
            'todaySales',
            'todayRevenue',
            'todayExpenses',
            'dueAmount',
            'totalMedicines',            
            'recentMedicines',
            'recentSales',
            'upcomingExpiry',
            'returnMedicines',
            'returnMedicineOptions',
            'returnCustomers',
            'returnCompanies',
            'recentProductReturns'
        ));
    }

    public function start()
    {
        if (Auth::check()) {
    // User is logged in
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }
    public function login()
    {
       echo "login";
    }

    public function lowStock(Request $request){
        $query = $request->input('search');

      $medicines = Medicine::query()
            ->where('is_active', 1)
            ->whereColumn('stock', '<=', 'stock_alert')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', "%{$query}%")
                        ->orWhere('generic_name', 'like', "%{$query}%")
                        ->orWhere('brand', 'like', "%{$query}%");                        
                });                   
            })
            ->orderBy('name')
            ->get();
        return response()->json($medicines);

    }

    public function upcomingExpiry()
    {
        return response()->json($this->upcomingExpiryMedicines());
    }

    private function upcomingExpiryMedicines()
    {
        return Medicine::query()
            ->where('expiry', '<=', now()->addDays(180))
            ->orderBy('expiry')
            ->get();
    }

   


    public function expense_store(Request $request)
    {    
        $validated = $request->validate([
            'expense_category_id' => ['required', 'exists:expense_categories,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        Expense::create([
            'expense_category_id' => $request->input('expense_category_id'),
            'amount' => $validated['amount'],
            'comment' => $validated['comment'],
            
        ]);

    return redirect()
            ->route('expense')
            ->with('success', 'Expense added successfully.');
        

    }
}
