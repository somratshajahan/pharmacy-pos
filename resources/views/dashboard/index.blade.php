@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>Dashboard</h1>
            <p>Quick counter summary for today and the stock that needs attention.</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('pos.index') }}">Open POS</a>
            <a class="btn btn-soft" href="{{ route('medicines.index') }}">Manage Stock</a>
        </div>
    </div>

    <section class="stats">
        <div class="stat">
            <div class="stat-label">Today Sales</div>
            <div class="stat-value">{{ number_format($todaySales, 2) }}</div>
        </div>        
        <div class="stat">
            <div class="stat-label">Today Revenue</div>
            <div class="stat-value">{{ number_format($todayRevenue, 2) }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Due Amount</div>
            <div class="stat-value">{{ number_format($dueAmount, 2) }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Today Expenses</div>
            <div class="stat-value">{{ number_format($todayExpenses, 2) }}</div>
        </div>
    </section>

    <div class="grid grid-3" style="margin-top: 18px;">
        
        <section class="panel-dashboard">
            <h2>Recent Sales</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Due</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentSales as $sale)
                        <tr>
                            <td><a href="{{ route('invoice.show', $sale) }}">{{ $sale->invoice_no }}</a></td>
                            <td>{{ $sale->customer?->name ?? 'Walk-in' }}</td>
                            <td>{{ number_format($sale->total, 2) }}</td>
                            <td>{{ number_format($sale->due, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No sales yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel-dashboard">
            <div class="split">
                <h2>Low Stock Alert</h2>
                <input id="searchLowStockByCompany" placeholder="search by company" style="max-width: 170px;">
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Stock</th>
                    </tr>
                    </thead>
                    <tbody id="lowStockTable">
                    
                    </tbody>
                </table>
            </div>
        </section>


        <section class="panel-dashboard">
            <div class="split">
                <h2>Upcoming Expiry Medicines</h2>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Expiry</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($upcomingExpiry as $expiry)
                        <tr>
                            <td>{{ $expiry->name }}</td>
                            <td>{{ $expiry->category ?: '-' }}</td>
                            <td>
                                <span class="pill {{ $expiry->stock <= 5 ? 'pill-danger' : 'pill-warn' }}">
                                    {{ $expiry->stock }}
                                </span>
                            </td>
                            <td>{{ $expiry->expiry }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No upcoming expiry medicines.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script>
    const searchCompany = document.getElementById('searchLowStockByCompany');
    const tableBody = document.getElementById('lowStockTable');

    fetchProducts();

    searchCompany.addEventListener('input', function () {
        let query = this.value;
        //alert(query);
        fetchProducts(query);
    });

    function fetchProducts(query = '') {
        fetch(`/lowStock/search?search=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = ''; 

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">No medicines found.</td></tr>`;
                return;
            }

            data.forEach(medicine => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${medicine.name}</td>
                    <td>${medicine.category}</td>
                    <td><span class="pill ${medicine.stock <= medicine.stock_alert ? 'pill-danger' : 'pill-warn' }">
                            ${medicine.stock}          
                        </span>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    }
    </script>

@endsection
