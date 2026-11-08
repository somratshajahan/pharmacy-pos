@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <h1>Expenses</h1>
            <p>Input all expenses & show expense history.</p>
        </div>
    </div>

    <div class="grid grid-2">
        <section class="panel">
            <h2>Add Expense</h2>
            <form method="POST" action="{{ route('expense.store') }}" class="stack">
                @csrf                                  
                    <div>
                        <label for="expense_category_id">Expense for </label>
                        <select id="expense_category_id" name="expense_category_id" required>
                            <!-- <option value="">Select Category</option> -->
                            @forelse($expenseCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                <option value="">No categories available</option>
                            @endforelse
                        </select>
                    </div>
                    <div>
                        <label for="amount">Amount</label>
                        <input id="amount" name="amount" type="number" step="0.01" required>
                    </div>
                    <div>
                        <label for="comment">Comment</label>
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    
                <button class="btn btn-primary" type="submit">Save Expense</button>
            </form>
        </section>

        <section class="panel soft">
            <h2>Expense Summary</h2>
            <div class="stack">
                <div class="meta">Entry any expense details here. Here is some category, we define. If you need another category select other option & write a comment about this.</div>
                <div class="meta">Show your expense history for whole day.</div>
            </div>
        </section>
    </div>

    <section class="panel" style="margin-top: 18px;">
        <div class="split">
            <h2>Expense List</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>For Expense</th>
                    <th>Amount</th>
                    <th>Comment</th>
                    <th>Date</th>
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
    </section>
    <script>

        const tableBody = document.getElementById('table-body');
        fetchExpenses();

        function fetchExpenses(page=1) {
            fetch(`/expenses/search?page=${page}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
                  
             tableBody.innerHTML = '';
             let expenses = data.data; 

        if (expenses.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="6">No expenses found.</td></tr>';
            document.getElementById('pagination-container').innerHTML = ''; 
            return;
        }
        expenses.forEach(expense => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${expense.id}</td>
            <td>${expense.category_name}</td>
            <td>${expense.amount}</td>
            <td>${expense.comment ? expense.comment : '-'}</td>
            <td>${expense.created_at ? new Date(expense.created_at).toLocaleString() : '-'}</td> `;

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
    
    if (page) {
        fetchExpenses(page);
    }
}   
    </script>
@endsection
