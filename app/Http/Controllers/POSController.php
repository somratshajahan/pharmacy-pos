<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;

use Illuminate\Http\Request;


class POSController extends Controller
{
    public function index()
    {
        $medicines = Medicine::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->take(30)
            ->get();

        $customers = Customer::query()
            ->orderBy('name')
            ->get();

        return view('pos.index', compact('medicines', 'customers'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $medicines = Medicine::query()
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('generic_name', 'like', "%$query%")
                    ->orWhere('brand', 'like', "%$query%")
                    ->orWhere('barcode', 'like', "%$query%");
            })
            ->orderBy('name')
            ->take(10)
            ->get();
        return response()->json($medicines);
    }

    
}
