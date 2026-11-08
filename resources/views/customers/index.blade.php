@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>Customers</h1>
            <p>Track due customers, ledger history, and payment collection.</p>
        </div>
    </div>

    <div class="grid grid-2">
        <section class="panel">
            <h2>Add Customer</h2>
            <form method="POST" action="{{ route('customers.store') }}" class="stack">
                @csrf
                <div class="row">
                    <div>
                        <label for="customer_name">Customer Name</label>
                        <input id="customer_name" name="name" required>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Save Customer</button>
            </form>
        </section>

        <section class="panel soft">
            <h2>Due Summary</h2>
            <div class="stack">
                <div class="meta">Customers with due can be selected during checkout and paid later from their ledger page.</div>
                <div class="meta">Walk-in sales stay supported, but due sales require a customer so the balance has somewhere to live.</div>
            </div>
        </section>
    </div>

    <section class="panel" style="margin-top: 18px;">
        <div class="split">
            <h2>Customer List</h2>
            <input id="searchCustomer" placeholder="Search by id, name, phone" style="max-width: 500px;">
            <div class="meta">{{ $customers->count() }} customers</div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Sales</th>
                    <th>Due</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="table-body">
             
                </tbody>
            </table>
            <nav>             
                <ul id="pagination-container" style="display: flex; list-style: none; padding: 0;">
                    <!-- জাভাস্ক্রিপ্ট দিয়ে এখানে পেজিনেশন বাটনগুলো আসবে -->
                </ul>
            </nav>
        </div>
         <div id="toast-container" class="toast-container"></div>
    </section>
            
            <!-- Customer edit modal -->
            <div id="editCustomerModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; width: 400px; position: relative;">
                    <h3>Edit Customer</h3>
                    <form id="editCustomerForm">
                        <div>
                            <input type="hidden" id="edit_customer_id" name="name" required>
                            <label for="editCustomerName">Name</label>
                            <input type="text" id="editCustomerName" name="name" required>
                        </div>
                        <div>
                            <label for="editCustomerPhone">Phone</label>
                            <input type="text" id="editCustomerPhone" name="phone">
                        </div>
                        <div style="text-align: right; margin-top: 10px;">
                            <button type="button" id="closeModalBtn" 
                            style="background-color: #e5e7eb; color: #374151; border: none;
                            font-size: 14px; cursor: pointer; padding: 10px 20px; margin-right: 5px;
                            border-radius: 4px;">Cancel</button>
                            <button type="submit" 
                            style="background-color: #059669; color: #fff; border: none;
                            font-size: 14px; cursor: pointer; padding: 10px 20px; margin-right: 5px;
                            border-radius: 4px; font-weight: bold;">Update</button>
                        </div>
                    </form>
                </div>
            </div>

    <script>

    const searchInput = document.getElementById('searchCustomer');
    const tableBody = document.getElementById('table-body');

       fetchCustomers();

    searchInput.addEventListener('input', function () {
        let query = this.value;        
        fetchCustomers(1,query);
    });

     function fetchCustomers(page=1, query = '') {
            fetch(`/customers/search?search=${encodeURIComponent(query)}&page=${page}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
                  
             tableBody.innerHTML = '';
             let customers = data.data; 

        if (customers.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4">No customers found.</td></tr>';
            document.getElementById('pagination-container').innerHTML = ''; 
            return;
        }
        customers.forEach(customer => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.phone}</td>
                    <td>${customer.sales_count}</td>
                        <td>
                            <span class="pill ${ customer.total_due > 0 ? 'pill-warn' : 'pill-ok' }">
                                ${customer.total_due}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-soft ladger-btn" href="/customers/${customer.id}">Open Ledger</a>
                            <button type="button" class="btn btn-soft edit-customer-btn" data-id="${customer.id}" style="margin-left: 5px;">
                                Edit
                            </button>
                        </td>`;
            tableBody.appendChild(row);
        });
                    
                 
         

            let paginationHtml = '';
            if (data.links) {
                    data.links.forEach(link => {
                let activeClass = link.active ? 'active' : '';
                let disabledClass = !link.url ? 'disabled' : '';
                
                // URL থেকে পেজ নম্বর বের করার লজিক
                let pageNum = link.url ? new URL(link.url, window.location.origin).searchParams.get('page') : 1;

                paginationHtml += `
                    <li class="page-item ${activeClass} ${disabledClass}" style="margin-right: 8px;">
                        <a class="page-link" href="#" onclick="changePage(event, '${pageNum}')">${link.label}</a>
                    </li>
                `;
                });
            }                
            document.getElementById('pagination-container').innerHTML = paginationHtml;         
        })
        .catch(error => console.error('Error:', error));
          }
         
    function changePage(event, page) {
    event.preventDefault();
    let query = searchInput.value;
    if (page) {
        fetchCustomers(page, query);
    }
}     

             // Customer edit modal open/close logic
        const modal = document.getElementById('editCustomerModal');
        const closeBtn = document.getElementById('closeModalBtn');

        closeBtn.addEventListener('click', () => {
            document.getElementById('editCustomerForm').reset();
            modal.style.display = 'none';
        });

        document.addEventListener('click', function(e) {    
            if (e.target && e.target.classList.contains('edit-customer-btn')) {
                let customerId = e.target.getAttribute('data-id');
        
        fetch(`/customers/${customerId}/edit`)
            .then(response => response.json())
            .then(data => {      
               
                document.getElementById('edit_customer_id').value = data.id;
                document.getElementById('editCustomerName').value = data.name;
                document.getElementById('editCustomerPhone').value = data.phone;
                 modal.style.display = 'flex';
               
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to fetch customer data.');
            });
            }
         });

    document.getElementById('editCustomerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let customerId = document.getElementById('edit_customer_id').value;

            const formData = new FormData(this); 
    fetch(`/customer/update/${customerId}`, { 
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data.success) {  
                      
            document.getElementById('editCustomerForm').reset(); 
            document.getElementById('editCustomerModal').style.display = 'none';
            let query = document.getElementById('searchCustomer').value;            
            fetchCustomers(query);
            showGreenToast(data.message);

        } else {
            showRedToast(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    }); 

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

    </script>
@endsection
