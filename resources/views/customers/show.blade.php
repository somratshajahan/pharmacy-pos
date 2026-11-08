@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $customer->name }}</h1>
            <p>{{ $customer->phone ?: 'No phone added' }} | Current due: {{ number_format($customer->total_due, 2) }} BDT</p>
        </div>
        <div class="actions">
            <a class="btn btn-soft" href="{{ route('customers.index') }}">Back to Customers</a>
        </div>
    </div>

    <div class="grid grid-2">
        <section class="panel">
            <h2>Add Payment</h2>
            <form method="POST" action="{{ route('customers.payment', $customer) }}" class="stack">
                @csrf
                <div class="row">
                    <div>
                        <label for="amount">Amount</label>
                        <input id="amount" name="amount" type="number" step="0.01" min="0.01" required>
                    </div>
                    <div>
                        <label for="note">Note</label>
                        <input id="note" name="note" placeholder="Optional note">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Record Payment</button>
            </form>
        </section>

        <section class="panel">
            <h2>Payment History</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customer->payments as $payment)
                        <tr>
                            <td>{{ $payment->created_at->format('d M Y h:i A') }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->note ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No payments yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section class="panel" style="margin-top: 18px;">
        <h2>Purchase Ledger</h2>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customer->sales as $sale)
                    <tr>
                        <td><a href="{{ route('invoice.show', $sale) }}">{{ $sale->invoice_no }}</a></td>
                        <td>{{ $sale->created_at->format('d M Y h:i A') }}</td>
                        <td>
                            @foreach($sale->items as $item)
                                <div>{{ $item->medicine_name }} x {{ $item->quantity }}</div>
                            @endforeach
                        </td>
                        <td>{{ number_format($sale->total, 2) }}</td>
                        <td>{{ number_format($sale->paid, 2) }}</td>
                        <td>{{ number_format($sale->due, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No sales for this customer yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
