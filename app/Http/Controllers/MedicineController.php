<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicineController extends Controller
{
    private const MEDICINE_CATEGORIES = [
        'Tablet',
        'Capsule',
        'Syrup',
        'Drop',
        'Suppository',
        'Device',
        'Spray',
        'Solution',
        'Cream',
        'Ointment',
        'Sachets',
        'Shampoo',
        'Soap',
        'Injection',
        'Syringe',
        'Pampers',
    ];

    public function index(){
        $medicines = Medicine::query()
            ->orderBy('name', 'asc')
            ->paginate(30);
        return view('medicines.index', [
            'medicines' => $medicines,
            'categories' => self::MEDICINE_CATEGORIES,
        ]);
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

    public function suggestions(Request $request)
    {
        $validated = $request->validate([
            'query' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        $names = Medicine::query()
            ->where('name', 'like', '%' . $validated['query'] . '%')
            ->orderBy('name')
            ->limit(10)
            ->pluck('name')
            ->unique()
            ->values();

        return response()->json($names);
    }



    public function store(Request $request){
        $validated = $this->validateMedicine($request);
        $medicine = Medicine::create($validated);

        return redirect()
            ->route('medicines.index')
            ->with('success', "Medicine '{$medicine->name}' added successfully.");
    }

   public function update(Request $request, $id)
   {
       $product = Medicine::findOrFail($id);
       $validated = $this->validateMedicine($request, (int) $id);
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medicines', 'name')
                    ->where('category', $request->input('category'))
                    ->ignore($medicineId),
            ],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'category' => ['required', Rule::in(self::MEDICINE_CATEGORIES)],
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
        ], [
            'name.unique' => 'This brand name already exists in the selected category.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
