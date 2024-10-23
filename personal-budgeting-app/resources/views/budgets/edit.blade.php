<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h1>Welcome, {{ auth()->user()->name }}</h1>
                    <h1>Edit Budget</h1>

                    <form action="{{ route('budgets.update', $budget) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="total_income">Total Income:</label>
                        <input type="number" name="total_income" value="{{ $budget->total_income }}" required>

                        <label for="total_expenses">Total Expenses:</label>
                        <input type="number" name="total_expenses" value="{{ $budget->total_expenses }}" required>

                        <label for="budget_limit">Budget Limit:</label>
                        <input type="number" name="budget_limit" value="{{ $budget->budget_limit }}" required>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
