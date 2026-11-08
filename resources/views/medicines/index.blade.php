@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>Medicine Management</h1>
            <p>Add, update, deactivate, and track stock from one place.</p>
        </div>
    </div>

            <!-- 2nd row -->
        <div class="grid grid-2">
        <section class="panel">
            <h2>Add Medicine</h2>
            <form method="POST" action="{{ route('medicines.store') }}" class="stack">
                @csrf
                <div class="row">
                    <div>
                        <label for="name">Brand Name</label>
                        <input id="name" name="name" required>
                    </div>
                    <div>
                        <label for="generic_name">Generic Name</label>
                        <input id="generic_name" name="generic_name">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="brand">Company</label>
                        <input id="brand" name="brand">
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <input id="category" name="category" placeholder="Tablet, Syrup, Injection">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="barcode">Barcode</label>
                        <input id="barcode" name="barcode">
                    </div>
                    <div>
                        <label for="stock">Stock</label>
                        <input id="stock" name="stock" type="number" min="0" value="0" required>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="batch">Batch no.</label>
                        <input id="batch_no" name="batch_no">
                    </div>
                    <div>
                        <label for="stock_alert">Stock Alert</label>
                        <input id="stock_alert" name="stock_alert" type="number" min="0" value="0" required>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="purchase_price">Purchase Price</label>
                        <input id="purchase_price" name="purchase_price" type="number" step="0.01" min="0" required>
                    </div>
                    <div>
                        <label for="sell_price">Sell Price</label>
                        <input id="sell_price" name="sell_price" type="number" step="0.01" min="0" required>
                    </div>
                </div>
                  <div class="row">
                    
                    <div>
                        <label for="expiry">Expiry Date</label>
                        <input id="expiry" name="expiry" type="date" required>
                    </div>
                </div>
                <div>
                    <label><input type="checkbox" name="is_active" value="1" checked style="width:auto;"> Active</label>
                </div>
                <button class="btn btn-primary" type="submit">Save Medicine</button>
            </form>
        </section>

        <section class="panel soft">
            <h2>Medicine Notes</h2>
            <div class="stack meta">
                <div>Use inactive status when a product should stay in history but stop showing in POS.</div>
                <div>Barcode stays unique so future scanner support can plug in cleanly.</div>
                <div>Stock edits here are the manual stock update path from your PRD.</div>
            </div>
        </section>
    </div>

        <!-- Medicine List -->
    <section class="panel" style="margin-top: 18px;">
        <div class="split">
            <h2>Medicine List</h2>
            <input id="searchMedicine" placeholder="Search by name, generic, company, barcode" style="max-width: 500px;">
            <div class="meta">{{ $medicines->total() }} medicines</div>
        </div>

        <div class="table-wrap">
            <table>
            <thead>
                <tr>
                    <th style="width: 8%;">Name</th>
                    <th>Generic</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>Barcode</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th>Stock</th>
                    <th>Add</th>
                    <th>Batch</th>
                    <th>Expiry</th>
                    <th>Stock Alert</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody id="medicineTable">
                     
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




<script>
    const searchInput = document.getElementById('searchMedicine');
    const tableBody = document.getElementById('medicineTable');

    fetchProducts();   

    searchInput.addEventListener('input', function () {
        let query = this.value;          
         fetchProducts(1, query);      
    });

         function fetchProducts(page=1, query = '') {
            fetch(`/medicines/search?search=${encodeURIComponent(query)}&page=${page}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
              console.log(data);     
             tableBody.innerHTML = '';
             let medicines = data.data;              

        if (medicines.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4">No medicines found.</td></tr>';
            document.getElementById('pagination-container').innerHTML = ''; 
            return;
        }
        medicines.forEach(medicine => {
            const row = document.createElement('tr');
            row.innerHTML = `
                    <td><input name="name" value="${medicine.name}"></td>
                    <td><input name="generic_name" value="${medicine.generic_name}"></td>
                    <td><input name="brand" value="${medicine.brand}"></td>
                    <td><input name="category" value="${medicine.category}"></td>
                    <td><input name="barcode" value="${medicine.barcode ?? ''}"></td>
                    <td><input name="purchase_price" value="${medicine.purchase_price}"></td>
                    <td><input name="sell_price" value="${medicine.sell_price}"></td>
                    <td><input name="stock" value="${medicine.stock}" readonly></td>
                    <td><input name="add" type="number" min="0" value="0"></td>
                    <td><input name="batch_no" value="${medicine.batch_no ?? '-' }"></td>
                    <td><input name="expiry" type="date" value="${medicine.expiry }" ></td>
                    <td><input name="stock_alert" type="number" min="0" value="${medicine.stock_alert}"></td>
                    <td>
                        <select name="is_active">
                            <option value="1" ${(medicine.is_active==1 ? 'selected' : '')}>Active</option>
                            <option value="0" ${(medicine.is_active==0 ? 'selected' : '')}>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary update-btn" 
                        data-id="${medicine.id}" data-name="${medicine.name}">
                        Update
                        </button>
			<button class="btn btn-sm btn-danger delete-btn" 
                data-id="${medicine.id}" 
                data-name="${medicine.name}">Del</button>
                    </td>
            `;
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
        fetchProducts(page, query);
    }
}     



    // Event delegation for update buttons
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('update-btn')) {
            e.preventDefault();
            const productId = e.target.getAttribute('data-id');
            const productName = e.target.getAttribute('data-name');
            const row = e.target.closest('tr');

            const updatedData = {
                name: row.querySelector('input[name="name"]').value,
                generic_name: row.querySelector('input[name="generic_name"]').value,
                brand: row.querySelector('input[name="brand"]').value,
                category: row.querySelector('input[name="category"]').value,
                barcode: row.querySelector('input[name="barcode"]').value,
                purchase_price: row.querySelector('input[name="purchase_price"]').value,
                sell_price: row.querySelector('input[name="sell_price"]').value,
                stock: row.querySelector('input[name="stock"]').value,
                add: row.querySelector('input[name="add"]').value,
                batch_no: row.querySelector('input[name="batch_no"]').value,
                stock_alert: row.querySelector('input[name="stock_alert"]').value,
                expiry: row.querySelector('input[name="expiry"]').value,
                is_active: row.querySelector('select[name="is_active"]').value
            };

            let isConfirmed = confirm(`Are you sure you want to update '${productName}'?`);
            if(isConfirmed){
                fetch(`/medicines/${productId}/update`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
         
                },
                body: JSON.stringify(updatedData)
                })
                .then(response => response.json())
                .then(response => {
                if (response.success) {
                    fetchProducts(searchInput.value); // Refresh the table
                    showGreenToast(response.message);
                } else {
                    showRedToast('Failed to update medicine.');
                   }
            })
            .catch(error => console.error('Error:', error));
        }        
            
        }
    });

    // Event delegation for delete buttons
    document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('delete-btn')) {
        const productId = e.target.getAttribute('data-id');
        const productName = e.target.getAttribute('data-name');

        
        let isConfirmed = confirm(`You permanently want to delete '${productName}'?`);

        if (isConfirmed) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
               fetch(`/medicines/${productId}/delete`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    fetchProducts(); 
                    showGreenToast(data.message);
                    } else {
                    showRedToast('Failed to delete medicine.');
                    }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('কোথাও কোনো ত্রুটি ঘটেছে!');
            });
        }
    }
});

function showGreenToast(message) {
    const container = document.getElementById('toast-container');
	container.innerHTML = '';

    // নতুন টোস্ট এলিমেন্ট তৈরি
    const toast = document.createElement('div');
    toast.className = 'toast-success';
    
    // টিক চিহ্নসহ মেসেজ সেট করা
    toast.innerHTML = `<span>✓</span> <span>${message}</span>`;

    // কন্টেইনারে যুক্ত করা
    container.appendChild(toast);

    // ৩.৫ সেকেন্ড পর টোস্ট অটোমেটিক ডিলিট হবে
    setTimeout(() => {
        toast.remove();
    }, 3500);
}

function showRedToast(message) {
    const container = document.getElementById('toast-container');
	container.innerHTML = '';

    // নতুন টোস্ট এলিমেন্ট তৈরি
    const toast = document.createElement('div');
    toast.className = 'toast-error';
    
    // ক্রস (✖) চিহ্নসহ মেসেজ সেট করা
    toast.innerHTML = `<span>✖</span> <span>${message}</span>`;

    // কন্টেইনারে যুক্ত করা
    container.appendChild(toast);

    // ৩.৫ সেকেন্ড পর টোস্ট অটোমেটিক ডিলিট হবে
    setTimeout(() => {
        toast.remove();
    }, 3500);
}

</script>    

@endsection