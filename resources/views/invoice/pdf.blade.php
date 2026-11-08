<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 13px; }
        .header { margin-bottom: 20px; }
        h1 { margin: 0 0 6px; font-size: 22px; }
        p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #c7c7c7; padding: 8px; text-align: left; }
        th { background: #f1f3f5; }
        .numeric { text-align: right; }
        .summary { margin-top: 20px; width: 300px; margin-left: auto; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PharmacyPOS Invoice</h1>
        <p>Invoice: {{ $sale->invoice_no }}</p>
        <p>Date: {{ $sale->created_at->format('d M Y h:i A') }}</p>
        <p>Customer: {{ $sale->customer?->name ?? 'Walk-in Customer' }}</p>
    </div>

    <table>
        <thead>
        <tr>
            <th>Medicine</th>
            <th class="numeric">Price</th>
            <th class="numeric">Qty</th>
            <th class="numeric">Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->medicine_name }}</td>
                <td class="numeric">{{ number_format($item->price, 2) }}</td>
                <td class="numeric">{{ $item->quantity }}</td>
                <td class="numeric">{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <th>Total</th>
            <td class="numeric">{{ number_format($sale->total, 2) }}</td>
        </tr>
        <tr>
            <th>Paid</th>
            <td class="numeric">{{ number_format($sale->paid, 2) }}</td>
        </tr>
        <tr>
            <th>Due</th>
            <td class="numeric">{{ number_format($sale->due, 2) }}</td>
        </tr>
    </table>
</body>
</html>
