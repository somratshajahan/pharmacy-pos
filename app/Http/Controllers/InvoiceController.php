<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show(Sale $sale)
    {
        $sale->load(['items', 'customer']);

        return view('invoice.show', compact('sale'));
    }

    public function pdf(Sale $sale)
    {
        $sale->load(['items', 'customer']);

        $pdf = Pdf::loadView('invoice.pdf', compact('sale'));

        return $pdf->download('invoice-' . $sale->invoice_no . '.pdf');
    }
}
