<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
     public function index()
    {
        $expenseCategories= DB::table('expense_categories')->get();      

        return view('expenses.index', compact('expenseCategories'));
    }

    public function search()
    {
        $expenses = DB::table('expenses')
            ->join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')
            ->select('expenses.*', 'expense_categories.name as category_name')
            ->orderBy('expenses.created_at', 'desc')
            ->paginate(50);
            
            return response()->json($expenses);
    }
}
