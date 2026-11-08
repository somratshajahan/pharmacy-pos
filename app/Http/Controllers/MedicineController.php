<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicineController extends Controller
{
    public function index(){
        $medicines = Medicine::query()
            ->orderBy('name', 'asc')
            ->paginate(30);
        return view('medicines.index', compact('medicines'));
    }



     public function search(Request $request)
    {
        $query = $request->input('search');

      $medicines = Medicine::query()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('generic_name', 'like', "%$query%")
                    ->orWhere('brand', 'like', "%$query%")
                    ->orWhere('barcode', 'like', "%$query%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        return response()->json($medicines);
    }

   


    public function store(Request $request){
        $validated = $this->validateMedicine($request);
        Medicine::create($validated);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine added successfully.');
    }

   public function update(Request $request, $id)
    {
     $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'barcode' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('medicines', 'barcode')->ignore($id),
            ],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'batch_no' => ['nullable', 'string', 'max:100'],
            'expiry' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'stock_alert' => ['required', 'integer', 'min:0'],
            'add' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        
        $product = Medicine::findOrFail($id);
	    $totalStock = $product->stock + $request->input('add', 0);
        $validated['stock'] = $totalStock;
    
        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Medicine updated successfully.',
            'product' => $product
        ], 200);
    }


    public function delete($id)
    {
        $product = Medicine::findOrFail($id);
        $product->delete();

        return response()->json([
        'success' => true,
        'message' => 'Successfully deleted the product.',
        ]);
    }


    private function validateMedicine(Request $request, ?int $medicineId = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'barcode' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('medicines', 'barcode')->ignore($medicineId),
            ],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'batch_no' => ['nullable', 'string', 'max:100'],
            'expiry' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'stock_alert' => ['required', 'integer', 'min:0'],
            'add' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
