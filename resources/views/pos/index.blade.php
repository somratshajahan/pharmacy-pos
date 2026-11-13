@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>POS Counter</h1>
            <p>Search fast, add to cart, validate stock, and finish the sale in one screen.</p>
        </div>
    </div>

    <div class="grid grid-2">
        <section class="panel">
            <div class="split">
                <h2>Medicine Search</h2>
                <input id="searchInput" placeholder="Search by name, generic, company, barcode" title="Alt+S or F2" style="max-width: 500px;">
            </div>

            <div class="table-wrap" style="margin-top: 12px; max-height: 640px; overflow-y: auto;">
                <table>
                    <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Batch</th>                        
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Expiry</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="medicineTable">
                    
                     
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <h2>Checkout</h2>
            <div class="stack">
               
                <div style="position: relative;" id="customerSearchContainer">                    
                    <label>Customer:</label>
                    <div style="display: flex; gap:8px; align-items: center; width: 100%;">
                    <input type="text" 
                            id="searchCustomer" 
                            class="form-control" 
                            placeholder="Walk-in Customer" 
                                autocomplete="off"
                                style="flex:1;">

                    <button type="button"
                            id="addCustomerBtn"
                            style="font-size: 14px; font-weight: bold; padding: 5px 12px; cursor: pointer;"
                            title="Add New Customer">+</button>            
                    </div>
                            <!-- div for live search -->
                        <div id="customerList" 
                                style="position: absolute; width: 100%; background: #fff; z-index: 999; border: 1px solid #ccc; border-radius: 4px; max-height: 200px; overflow-y: auto; display: none;">
                        </div>
                             <input type="hidden" name="customer_id" id="selectedCustomerId" value="">
                        </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th class="numeric">Price</th>
                            <th class="numeric">Qty</th>
                            <th class="numeric">Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="cartTable">
                        <tr>
                            <td colspan="5">Cart is empty.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="panel soft" style="padding: 14px;">
                        <label>Total</label>
                        <div id="totalDisplay" style="font-size: 26px; font-weight: 700;">0.00</div>
                    </div>
                    <div>
                        <div>
                            <label for="discount" title="Alt+D">Discount</label>
                            <input id="discount" type="number" title="Alt+D" min="0" step="1" value="0">
                        </div>
                        <div> 
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 4px;">
                                <label for="paid_amount">Paid Amount</label>
                                <div style="display: flex; align-items: center; gap:5px; white-space: nowrap;">
                                    <input type="checkbox" id="fullPaid" title="Alt+F" style="cursor:pointer;">
                                    <label for="fullPaid" title="Alt+F" style="cursor:pointer; font-size: 14px; font-weight: normal;">Paid in full</label>
                                </div>                                
                            </div> 
                            <input id="paid_amount" type="number" min="0" step="1" value="0"> 
                        </div>
                    </div>
                </div>

                <div class="panel soft" style="padding: 14px;">
                    <div class="split">
                        <strong>Due Amount</strong>
                        <strong id="dueDisplay">0.00</strong>
                    </div>
                </div>

                <button class="btn btn-primary btn-full" type="button" 
                id="completeSaleBtn" title="Ctrl+Enter (or F10)"
                onclick="checkout()">Complete Sale</button>
                <div id="checkoutMessage" class="meta"></div>
            </div>            
        </section>
    </div>

            <!-- New customer add modal -->
            <div id="newCustomerModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; width: 400px; position: relative;">
                    <h3>Add New Customer</h3>
                    <form id="newCustomerForm">
                        <div>
                            <label for="newCustomerName">Name</label>
                            <input type="text" id="newCustomerName" name="name" required>
                        </div>
                        <div>
                            <label for="newCustomerPhone">Phone</label>
                            <input type="text" id="newCustomerPhone" name="phone" required>
                        </div>
                        <div style="text-align: right; margin-top: 10px;">
                            <button type="button" id="closeModalBtn" 
                            style="background-color: #e5e7eb; color: #374151; border: none;
                            font-size: 14px; cursor: pointer; padding: 10px 20px; margin-right: 5px;
                            border-radius: 4px;">Cancel</button>
                            <button type="submit" 
                            style="background-color: #059669; color: #fff; border: none;
                            font-size: 14px; cursor: pointer; padding: 10px 20px; margin-right: 5px;
                            border-radius: 4px; font-weight: bold;">Save Customer</button>
                        </div>
                    </form>
                </div>
            </div>
    <div id="toast-container" class="toast-container"></div>

    <script>

        // New customer search logic
        const searchCustomer = document.getElementById('searchCustomer');
        const customerList = document.getElementById('customerList');
        const selectedCustomerId = document.getElementById('selectedCustomerId');                
           
        searchCustomer.addEventListener('input', function () {
            let query = this.value.trim();
            
                if (query.length === 0) {
                    customerList.innerHTML = '';
                    customerList.style.display = 'none';
                    selectedCustomerId.value = '';                    
                    return; 
                    }  
         
            fetch(`/customers/search2?search=${encodeURIComponent(query)}`, {
                
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                     }
            })
            .then(response => response.json())
            .then(data => {
            customerList.innerHTML = '';
          
        if (data.length === 0) {
            customerList.innerHTML = `<div style="padding: 10px; color: #888;">No customers found.</div>`;
            customerList.style.display = 'block';
            return;
        }
       
        data.forEach(customer => {
            const item = document.createElement('div');
            item.style.padding = '10px';
            item.style.cursor = 'pointer';
            item.style.borderBottom = '1px solid #eee';
            item.innerHTML = `<strong>${customer.name}</strong> <small class="text-muted">(${customer.phone || 'No number'}) | Due: ${customer.total_due}</small>`;

           
            item.addEventListener('click', function () {
                searchCustomer.value = `${customer.name} - current due: ${customer.total_due}`;
                selectedCustomerId.value = customer.id;
                customerList.innerHTML = '';
                customerList.style.display = 'none'; 
            });

            customerList.appendChild(item);
        });

        customerList.style.display = 'block';
    })
    .catch(error => console.error('Error fetching customers:', error));
});


document.addEventListener('click', function (e) {
    if (!document.getElementById('customerSearchContainer').contains(e.target)) {
        customerList.style.display = 'none';
    }
              
    }); //end of searchCustomer input event

            fetchMedicine();

        document.getElementById('searchInput').addEventListener('input', function () {
            const queryKey = this.value.toLowerCase().trim();
                fetchMedicine(queryKey);
            });    

        function fetchMedicine(query = ''){     
            const tbody = document.getElementById('medicineTable');

            fetch('{{ route("pos.search") }}?search=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    tbody.innerHTML= '';

                    if(data.length === 0){
                        tbody.innerHTML= '<tr><td colspan="5" style="text-align: center;">No medicines found for this query.</td></tr>'; 
                        return;
                    }

                    data.forEach(medicine => {
                        const row = document.createElement('tr');
                        row.setAttribute('data-id', medicine.id);
                        row.setAttribute('data-name', medicine.name);
                        row.setAttribute('data-price', medicine.sell_price);
                        row.setAttribute('data-stock', medicine.stock);

                        row.innerHTML = `
                            <td>${medicine.barcode || '-'}</td>
                            <td>
                                <strong>${medicine.name}</strong>
                                <div class="meta">${medicine.generic_name || 'No generic'}</div>
                            </td>
                            <td>${medicine.category || '-'}</td>
                            <td>${medicine.brand || '-'}</td>
                            <td>${medicine.batch_no || '-'}</td>                            
                            <td>${Number(medicine.sell_price).toFixed(2)}</td>
                            <td>
                                <span class="pill ${medicine.stock <= 5 ? 'pill-danger' : (medicine.stock <= 10 ? 'pill-warn' : 'pill-ok')}">
                                    ${medicine.stock}
                                </span>
                            </td>
                            <td>${medicine.expiry || '-'}</td>
                            <td>
                                <button class="btn btn-soft" type="button" onclick="addToCart(${medicine.id}, '${medicine.name.replace(/'/g, "\\'")}', ${medicine.sell_price}, ${medicine.stock})">+</button>
                            </td>`;
                        tbody.appendChild(row);
                    });                 
                });
        }

        const cart = [];

        function currency(value) {
            return Number(value).toFixed(2);
        }

        function addToCart(medicineId, name, price, stock) {
            const existing = cart.find(item => item.medicine_id === medicineId);

            if (existing) {
                if (existing.quantity >= existing.stock) {
                    alert('Not enough stock for this medicine.');
                    return;
                }
                existing.quantity += 1;
            } else {
                if (stock <= 0) {
                    alert('This medicine is out of stock.');
                    return;
                }

                cart.push({
                    medicine_id: medicineId,
                    name,
                    price: Number(price),
                    quantity: 1,
                    stock: Number(stock)
                });
            }
            renderCart();

            setTimeout(() => {
                const qtyInputs = document.querySelectorAll('.qty-input');
                if(qtyInputs.length > 0){
                    const lastInput = qtyInputs[qtyInputs.length - 1];
                    lastInput.focus();
                    lastInput.select();
                }
            },100);
        }

        function changeQty(medicineId, nextQty) {
            const item = cart.find(entry => entry.medicine_id === medicineId);

            if (!item) {
                return;
            }

            if (nextQty < 1) {
                removeItem(medicineId);
                return;
            }

            if (nextQty > item.stock) {
                alert('Not enough stock for this quantity.');
                return;
            }

            item.quantity = nextQty;
            renderCart();
        }

        function removeItem(medicineId) {
            const index = cart.findIndex(item => item.medicine_id === medicineId);

            if (index >= 0) {
                cart.splice(index, 1);
            }

            renderCart();
        }

        function getTotal() {
            return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        }

        const discountInput = document.getElementById('discount');
        discountInput.addEventListener('input', function(){
            renderCart();
        });

        const paidInput = document.getElementById('fullPaid');
        paidInput.addEventListener('change', function(){
            if(this.checked){
                const sub_total = getTotal();
                const discount = Number(document.getElementById('discount').value || 0);
                const total = Math.max(sub_total - discount, 0);
                document.getElementById('paid_amount').value = total;
                renderCart();
            }             
        });

        function renderCart() {
            const table = document.getElementById('cartTable');
            const sub_total = getTotal();
            const discount = Number(document.getElementById('discount').value || 0);
            const total = Math.max(sub_total - discount, 0);
            if (document.getElementById('fullPaid').checked) {
                document.getElementById('paid_amount').value = total;
            }
            const paid = Number(document.getElementById('paid_amount').value || 0);
            const due = Math.max(total - paid, 0);

            if (cart.length === 0) {
                table.innerHTML = '<tr><td colspan="5">Cart is empty.</td></tr>';
            } else {
                table.innerHTML = cart.map(item => `
                    <tr id="cart-item">
                        <td>${item.name}</td>
                        <td class="numeric">${currency(item.price)}</td>
                        <td class="numeric">
                            <div class="actions" style="justify-content: flex-end;">
                                <button class="btn btn-soft" type="button" onclick="changeQty(${item.medicine_id}, ${item.quantity - 1})">-</button>
                                <input type="number" min="1" max="${item.stock}" value="${item.quantity}" class="qty-input no-spin" 
                                 onchange="changeQty(${item.medicine_id}, Number(this.value))" style="width: 72px; text-align: right;">                                 
                                <button class="btn btn-soft" type="button" onclick="changeQty(${item.medicine_id}, ${item.quantity + 1})">+</button>
                            </div>
                        </td>
                        <td class="numeric">${currency(item.price * item.quantity)}</td>
                        <td>
                        <button class="btn btn-danger" type="button" onclick="removeItem(${item.medicine_id})">
                            Del
                        </button></td>
                    </tr>
                `).join('');            }

            document.getElementById('totalDisplay').textContent = currency(total);
            document.getElementById('dueDisplay').textContent = currency(due);
        }

        
         //    Button Complete Sale login, checkout method call
        async function checkout() {
            const total = getTotal();
            const discount= Number(document.getElementById('discount').value || 0);
            const paid = Number(document.getElementById('paid_amount').value || 0);
            const customerId = document.getElementById('selectedCustomerId').value;  
            const message = document.getElementById('checkoutMessage');

            if (cart.length === 0) {
                alert('Cart is empty.');
                return;
            }

            if (paid > total) {
                alert('Paid amount cannot be greater than total.');
                return;
            }

            message.textContent = 'Saving sale...';

            try {
                const response = await fetch('{{ route('sales.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        customer_id: customerId || null,
                        items: cart.map(item => ({
                            medicine_id: item.medicine_id,
                            quantity: item.quantity
                        })),
                        paid: paid,
                        discount: discount
                    })
                });

                const data = await response.json();
                if (!response.ok) {
                    if (data.errors) {
                        const flatErrors = Object.values(data.errors).flat();
                        throw new Error(flatErrors.join(' '));
                    }

                    throw new Error(data.message || 'Sale could not be completed.');
                }

                message.textContent = 'Sale completed. Opening invoice...';
                cart.splice(0, cart.length);
                document.getElementById('paid_amount').value = '0';
                document.getElementById('searchCustomer').value = '';
                document.getElementById('selectedCustomerId').value = '';
                renderCart();
                window.location.href = data.redirect_url;
            } catch (error) {
                message.textContent = '';
                alert(error.message);
            }
        }  // End of checkout function

        document.getElementById('paid_amount').addEventListener('input', function(){
            const fullPaidCheckbox= document.getElementById('fullPaid');
            if(fullPaidCheckbox){
                fullPaidCheckbox.checked = false;
            }
            renderCart();
        });

        

        renderCart();

        function showGreenToast(message) {
    const container = document.getElementById('toast-container');
	container.innerHTML = '';
    const toast = document.createElement('div');
    toast.className = 'toast-success'; 
    toast.innerHTML = `<span>✓</span> <span>${message}</span>`;    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3500);
}

function showRedToast(message) {
    const container = document.getElementById('toast-container');
	container.innerHTML = '';
    
    const toast = document.createElement('div');
    toast.className = 'toast-error';    
    toast.innerHTML = `<span>✖</span> <span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3500);
}

            // Add new customer modal open/close logic
        const openBtn = document.getElementById('addCustomerBtn');
        const modal = document.getElementById('newCustomerModal');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            document.getElementById('newCustomerForm').reset();
            modal.style.display = 'none';
        });

    document.getElementById('newCustomerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this); 

    fetch('customer/storeAjax', { 
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {            
            document.getElementById('newCustomerForm').reset(); 
            document.getElementById('newCustomerModal').style.display = 'none';
            showGreenToast(data.message);
        } else {
            showRedToast(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    });  
    // End of new customer listener//////////////////////


    </script>
    <script src="{{ asset('js/pos-shortcuts.js') }}"></script>
@endsection
