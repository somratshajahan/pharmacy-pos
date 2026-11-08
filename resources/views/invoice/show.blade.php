@extends('layouts.app')

@section('content')
    <div class="invoice-box">
        <div class="split" style="margin-bottom: 20px;">
            <div>
                <h1 style="margin: 0;">Invoice {{ $sale->invoice_no }}</h1>
                <p class="meta">{{ $sale->created_at->format('d M Y h:i A') }}</p>
                <p class="meta">Customer: {{ $sale->customer?->name ?? 'Walk-in Customer' }}</p>
            </div>
            <div class="actions">
                <a class="btn btn-soft" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="btn btn-primary" href="{{ route('invoice.pdf', $sale) }}">Download PDF</a>
            </div>
        </div>

        <div class="table-wrap">
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
        </div>

        <div style="margin-top: 20px; margin-left: auto; max-width: 320px;">
            <table>
                @if($sale->discount >0)
                    <tr>
                    <th>Discount</th>
                    <td class="numeric">{{ number_format($sale->discount, 2) }}</td>
                </tr>
                @endif
                
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
        </div>
    </div>
@endsection
