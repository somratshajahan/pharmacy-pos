<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::query()
            ->withCount('sales')
            ->orderBy('name')
            ->take(25)
            ->get();

        return view('customers.index', compact('customers'));
    }

    
     public function search(Request $request)
    {
        $query = $request->input('search');

      $customers = Customer::query()
            ->withCount('sales')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhere('id', 'like', "%$query%")
                  ->orWhere('phone', 'like', "%$query%");
            })
            ->orderBy('name')
            ->paginate(25);
           
        return response()->json($customers);
    }
    public function search2(Request $request)
    {
        $query = $request->input('search');

      $customers = Customer::query()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhere('id', 'like', "%$query%")
                  ->orWhere('phone', 'like', "%$query%");
            })
            ->orderBy('name')
            ->take(10)
            ->get();           
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Customer::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'total_due' => 0,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

     public function storeAjax(Request $request)
     {
        // ১. ভ্যালিডেশন
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    // ২. ডাটাবেজে কাস্টমার সেভ করা
    $customer = Customer::create([
        'name'  => $validated['name'],
        'phone' => $validated['phone'],
        'total_due' => 0,
    ]);

    // ৩. JSON আকারে রেসপন্স রিটার্ন করা
    return response()->json([
        'success'  => true,
        'message'  => 'Customer added successfully!'
        
        ]);

     }

    public function show(Customer $customer)
    {
        $customer->load([
            'sales' => fn ($query) => $query->latest()->with('items'),
            'payments' => fn ($query) => $query->latest()->take(5),
        ]);

        return view('customers.show', compact('customer'));
    }

    public function addPayment(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($customer, $validated) {
            $freshCustomer = Customer::query()
                ->lockForUpdate()
                ->findOrFail($customer->id);

            if ((float) $freshCustomer->total_due <= 0) {
                throw ValidationException::withMessages([
                    'amount' => ['This customer has no due balance.'],
                ]);
            }

            $amount = min(round((float) $validated['amount'], 2), (float) $freshCustomer->total_due);

            Payment::create([
                'customer_id' => $freshCustomer->id,
                'amount' => $amount,
                'note' => $validated['note'] ?? null,
            ]);

            $freshCustomer->decrement('total_due', $amount);
        });

        return redirect()
            ->route('customers.show', $customer)
            ->with('success', 'Payment recorded successfully.');
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }
    
    public function update(Request $request, $id){        
        $customer= Customer::findOrFail($id);

        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->save();
        return response()->json([           
            'success' => true,
            'message' => 'update successfully'
        ]);
    }
}
