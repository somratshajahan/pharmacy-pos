@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>Dashboard</h1>
            <p>Quick counter summary for today and the stock that needs attention.</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('pos.index') }}">Open POS</a>
            <button class="btn btn-soft" id="openProductReturn" type="button">Return</button>
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

    @if(session('success'))
        <div class="panel" style="margin-top: 18px; border-color: #027a48; color: #027a48;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="panel" style="margin-top: 18px; border-color: #b42318; color: #b42318;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-3" style="margin-top: 18px;">
        
        <section class="panel-dashboard">
            <h2>Recent Sales</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Medicines (Qty)</th>
                        <th>Total</th>
                        <th>Due</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentSales as $sale)
                        <tr>
                            <td><a href="{{ route('invoice.show', $sale) }}">{{ $sale->invoice_no }}</a></td>
                            <td>{{ $sale->customer?->name ?? 'Walk-in' }}</td>
                            <td>{{ $sale->items->map(fn ($item) => $item->medicine_name . ' (Qty: ' . $item->quantity . ')')->join(', ') ?: '-' }}</td>
                            <td>{{ number_format($sale->total, 2) }}</td>
                            <td>{{ number_format($sale->due, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No sales yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel-dashboard">
            <div class="split">
                <h2>Recently Added Products</h2>

            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>Generic</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentMedicines as $medicine)
                        <tr>
                            <td>{{ $medicine->name }}</td>
                            <td>{{ $medicine->generic_name ?: '-' }}</td>
                            <td>{{ $medicine->brand ?: '-' }}</td>
                            <td>{{ $medicine->category ?: '-' }}</td>
                            <td>{{ $medicine->stock }}</td>
                            <td>{{ $medicine->updated_at?->format('d M Y') ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No products added yet.</td>
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
                    <tr><td colspan="3">Loading low stock medicines...</td></tr>
                    
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
                    <tbody id="upcomingExpiryTable">
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

        <section class="panel-dashboard">
            <h2>Recent Product Returns</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Customer / Company</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentProductReturns as $productReturn)
                        <tr>
                            <td>{{ $productReturn->type === 'customer' ? 'Customer return' : 'To company' }}</td>
                            <td>{{ $productReturn->medicine_name }}</td>
                            <td>{{ $productReturn->quantity }}</td>
                            <td>{{ $productReturn->type === 'customer' ? ($productReturn->customer?->name ?? $productReturn->customer_name ?? '-') : $productReturn->company_name }}</td>
                            <td>{{ $productReturn->returned_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No product returns recorded yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div id="productReturnModal" style="display: none; position: fixed; inset: 0; z-index: 1000; background: rgba(15, 23, 42, .6); align-items: center; justify-content: center; padding: 18px;">
        <section class="panel" role="dialog" aria-modal="true" aria-labelledby="productReturnTitle" style="width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto;">
            <div class="split">
                <h2 id="productReturnTitle">Record Product Return</h2>
                <button class="btn btn-soft" id="closeProductReturn" type="button" aria-label="Close">Close</button>
            </div>
            <form method="POST" action="{{ route('product-returns.store') }}">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label for="returnType">Return type</label>
                    <select id="returnType" name="type" required>
                        <option value="customer" @selected(old('type', 'customer') === 'customer')>Customer return</option>
                        <option value="company" @selected(old('type') === 'company')>Return to company</option>
                    </select>
                </div>
                <div id="returnCustomerField" style="margin-bottom: 12px;">
                    <label for="returnCustomer">Customer</label>
                    <select id="returnCustomer" name="customer_id">
                        <option value="">Select customer</option>
                        @foreach($returnCustomers as $customer)
                            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="returnCompanyField" style="display: none; margin-bottom: 12px;">
                    <label for="returnCompany">Company</label>
                    <input id="returnCompany" name="company_name" list="returnCompanyOptions" value="{{ old('company_name') }}" maxlength="255">
                    <datalist id="returnCompanyOptions">
                        @foreach($returnCompanies as $company)
                            <option value="{{ $company }}">
                        @endforeach
                    </datalist>
                </div>
                <div style="margin-bottom: 12px;">
                    <label for="returnMedicineSearch">Search product</label>
                    <input id="returnMedicineSearch" type="search" placeholder="Type a product or company name" autocomplete="off">
                    <input id="returnMedicine" type="hidden" name="medicine_id" value="{{ old('medicine_id') }}" required>
                    <div id="returnMedicineResults" style="display: none; max-height: 180px; overflow-y: auto; border: 1px solid var(--border); border-radius: 8px; margin-top: 6px;"></div>
                    <div id="returnSelectedMedicine" class="meta" style="margin-top: 6px;"></div>
                </div>
                <div class="row" style="margin-bottom: 12px;">
                    <div>
                        <label for="returnQuantity">Quantity</label>
                        <input id="returnQuantity" type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" required>
                    </div>
                    <div>
                        <label for="returnedAt">Return date</label>
                        <input id="returnedAt" type="date" name="returned_at" value="{{ old('returned_at', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required>
                    </div>
                </div>
                <div class="actions">
                    <button class="btn btn-primary" type="submit">Save Return</button>
                    <button class="btn btn-soft" id="cancelProductReturn" type="button">Cancel</button>
                </div>
            </form>
        </section>
    </div>

    <script>
    const searchCompany = document.getElementById('searchLowStockByCompany');
    const lowStockTable = document.getElementById('lowStockTable');
    const upcomingExpiryTable = document.getElementById('upcomingExpiryTable');
    const returnType = document.getElementById('returnType');
    const returnCustomerField = document.getElementById('returnCustomerField');
    const returnCompanyField = document.getElementById('returnCompanyField');
    const returnCustomer = document.getElementById('returnCustomer');
    const returnCompany = document.getElementById('returnCompany');
    const productReturnModal = document.getElementById('productReturnModal');
    const returnMedicineSearch = document.getElementById('returnMedicineSearch');
    const returnMedicineInput = document.getElementById('returnMedicine');
    const returnMedicineResults = document.getElementById('returnMedicineResults');
    const returnSelectedMedicine = document.getElementById('returnSelectedMedicine');
    const returnMedicineOptions = @json($returnMedicineOptions);

    document.getElementById('openProductReturn').addEventListener('click', openProductReturn);
    document.getElementById('closeProductReturn').addEventListener('click', closeProductReturn);
    document.getElementById('cancelProductReturn').addEventListener('click', closeProductReturn);
    productReturnModal.addEventListener('click', function (event) {
        if (event.target === productReturnModal) closeProductReturn();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && productReturnModal.style.display === 'flex') {
            closeProductReturn();
        }
    });

    returnMedicineSearch.addEventListener('input', function () {
        returnMedicineInput.value = '';
        returnSelectedMedicine.textContent = '';
        renderReturnMedicineResults();
    });

    refreshInventoryAlerts();
    setInterval(refreshInventoryAlerts, 30000);

    document.addEventListener('visibilitychange', function () {
        if (!document.hidden) {
            refreshInventoryAlerts();
        }
    });

    searchCompany.addEventListener('input', function () {
        fetchProducts(this.value);
    });

    function updateReturnFields() {
        const returningToCompany = returnType.value === 'company';
        returnCustomerField.style.display = returningToCompany ? 'none' : '';
        returnCompanyField.style.display = returningToCompany ? '' : 'none';
        returnCustomer.required = !returningToCompany;
        returnCompany.required = returningToCompany;
    }

    returnType.addEventListener('change', updateReturnFields);
    updateReturnFields();

    if (@json($errors->any())) {
        openProductReturn();
    }

    function openProductReturn() {
        productReturnModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        returnMedicineSearch.focus();
        renderReturnMedicineResults();
    }

    function closeProductReturn() {
        productReturnModal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function renderReturnMedicineResults() {
        const query = returnMedicineSearch.value.trim().toLowerCase();
        returnMedicineResults.innerHTML = '';
        const matches = returnMedicineOptions.filter(medicine =>
            `${medicine.name} ${medicine.brand || ''}`.toLowerCase().includes(query)
        );

        matches.forEach(medicine => {
            const option = document.createElement('button');
            option.type = 'button';
            option.className = 'btn btn-soft';
            option.style.cssText = 'display: block; width: 100%; text-align: left; border-radius: 0;';
            option.textContent = `${medicine.name}${medicine.brand ? ` - ${medicine.brand}` : ''} (stock: ${medicine.stock})`;
            option.addEventListener('click', function () {
                returnMedicineInput.value = medicine.id;
                returnMedicineSearch.value = medicine.name;
                returnSelectedMedicine.textContent = `Selected: ${medicine.name} (stock: ${medicine.stock})`;
                if (returnType.value === 'company' && !returnCompany.value) {
                    returnCompany.value = medicine.brand || '';
                }
                returnMedicineResults.style.display = 'none';
            });
            returnMedicineResults.appendChild(option);
        });

        returnMedicineResults.style.display = matches.length ? 'block' : 'none';
    }

    function refreshInventoryAlerts() {
        fetchProducts(searchCompany.value);
        fetchUpcomingExpiry();
    }

    function fetchProducts(query = '') {
        fetch(`/lowStock/search?search=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            lowStockTable.innerHTML = '';

            if (data.length === 0) {
                lowStockTable.innerHTML = `<tr><td colspan="3" class="text-center text-muted">No medicines found.</td></tr>`;
                return;
            }

            data.forEach(medicine => {
                const row = document.createElement('tr');

                const nameCell = document.createElement('td');
                nameCell.textContent = medicine.name;
                row.appendChild(nameCell);

                const categoryCell = document.createElement('td');
                categoryCell.textContent = medicine.category || '-';
                row.appendChild(categoryCell);

                const stockCell = document.createElement('td');
                const stockPill = document.createElement('span');
                stockPill.className = `pill ${medicine.stock <= medicine.stock_alert ? 'pill-danger' : 'pill-warn'}`;
                stockPill.textContent = medicine.stock;
                stockCell.appendChild(stockPill);
                row.appendChild(stockCell);

                lowStockTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    }

    function fetchUpcomingExpiry() {
        fetch('{{ route('upcomingExpiry') }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Failed to load upcoming expiry medicines: ${response.status}`);
            }

            return response.json();
        })
        .then(data => {
            upcomingExpiryTable.innerHTML = '';

            if (data.length === 0) {
                upcomingExpiryTable.innerHTML = '<tr><td colspan="4">No upcoming expiry medicines.</td></tr>';
                return;
            }

            data.forEach(medicine => {
                const row = document.createElement('tr');
                const nameCell = document.createElement('td');
                nameCell.textContent = medicine.name;
                row.appendChild(nameCell);

                const categoryCell = document.createElement('td');
                categoryCell.textContent = medicine.category || '-';
                row.appendChild(categoryCell);

                const stockCell = document.createElement('td');
                const stockPill = document.createElement('span');
                stockPill.className = `pill ${medicine.stock <= 5 ? 'pill-danger' : 'pill-warn'}`;
                stockPill.textContent = medicine.stock;
                stockCell.appendChild(stockPill);
                row.appendChild(stockCell);

                const expiryCell = document.createElement('td');
                expiryCell.textContent = medicine.expiry || '-';
                row.appendChild(expiryCell);

                upcomingExpiryTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    }
    </script>

@endsection
