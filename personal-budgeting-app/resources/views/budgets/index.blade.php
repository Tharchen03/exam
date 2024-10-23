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
                        <!-- Success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h1>Your Budgets</h1>
                    <a href="{{ route('budgets.create') }}" class="btn btn-primary">Add New Budget</a>
                    <table>
                        <thead>
                            <tr>
                                <th>Total Income</th>
                                <th>Total Expenses</th>
                                <th>Budget Limit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $budget)
                                <tr>
                                    <td>{{ $budget->total_income }}</td>
                                    <td>{{ $budget->total_expenses }}</td>
                                    <td>{{ $budget->budget_limit }}</td>
                                    <td>
                                        <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('budgets.destroy', $budget) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h1>Table to display the budgets</h1>

                    <!-- Table to display the budgets -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Total Income</th>
                                <th>Total Expenses</th>
                                <th>Budget Limit</th>
                                <th>Remaining Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $budget)
                                <tr>
                                    <td>{{ $budget->total_income }}</td>
                                    <td>{{ $budget->total_expenses }}</td>
                                    <td>{{ $budget->budget_limit }}</td>
                                    <td>{{ $budget->total_income - $budget->total_expenses }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h1> Add a canvas element for Chart.js             </h1>
                    <!-- Add a canvas element for Chart.js -->
                    <canvas id="budgetChart" width="400" height="200"></canvas>

                    <script>
                        const ctx = document.getElementById('budgetChart').getContext('2d');
                        const budgetChart = new Chart(ctx, {
                            type: 'bar', // You can change this to 'line', 'pie', etc.
                            data: {
                                labels: @json($budgets->pluck('id')), // X-axis will show the budget IDs or any other label you want
                                datasets: [
                                    {
                                        label: 'Total Income',
                                        data: @json($budgets->pluck('total_income')),
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Total Expenses',
                                        data: @json($budgets->pluck('total_expenses')),
                                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
