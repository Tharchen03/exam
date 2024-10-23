<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
        ]);

        // Create transaction
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
        ]);

        // Update budget based on type (income or expense)
        $budget = Budget::where('user_id', auth()->id())->first();
        if ($validated['type'] == 'income') {
            $budget->total_income += $validated['amount'];
        } else {
            $budget->total_expenses += $validated['amount'];
        }
        $budget->save();

        return redirect()->back()->with('message', 'Transaction saved successfully.');
    }
}

