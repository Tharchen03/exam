<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // Display the list of budgets for the authenticated user
    public function index()
    {
        $budgets = Budget::where('user_id', auth()->id())->get();
        return view('budgets.index', compact('budgets'));
    }

    // Show the form to create a new budget
    public function create()
    {
        return view('budgets.create');
    }

    // Store a new budget in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_income' => 'required|numeric',
            'total_expenses' => 'required|numeric',
            'budget_limit' => 'required|numeric',
        ]);

        Budget::create([
            'user_id' => auth()->id(),
            'total_income' => $validated['total_income'],
            'total_expenses' => $validated['total_expenses'],
            'budget_limit' => $validated['budget_limit'],
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget added successfully!');
    }

    // Show the form to edit an existing budget
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget); // Ensure the user is authorized
        return view('budgets.edit', compact('budget'));
    }

    // Update the budget in the database
    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget); // Ensure the user is authorized

        $validated = $request->validate([
            'total_income' => 'required|numeric',
            'total_expenses' => 'required|numeric',
            'budget_limit' => 'required|numeric',
        ]);

        $budget->update($validated);

        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully!');
    }

    // Delete an existing budget
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget); // Ensure the user is authorized

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully!');
    }
}
