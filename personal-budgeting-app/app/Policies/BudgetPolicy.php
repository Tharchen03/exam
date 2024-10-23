<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BudgetPolicy
{
    /**
     * Determine whether the user can view any budgets.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view their budgets
    }

    /**
     * Determine whether the user can view the budget.
     */
    public function view(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id; // Only the owner can view their budget
    }

    /**
     * Determine whether the user can create budgets.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create budgets
    }

    /**
     * Determine whether the user can update the budget.
     */
    public function update(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id; // Only the owner can update their budget
    }

    /**
     * Determine whether the user can delete the budget.
     */
    public function delete(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id; // Only the owner can delete their budget
    }

    /**
     * Determine whether the user can restore the budget.
     */
    public function restore(User $user, Budget $budget): bool
    {
        return false; // Implement logic if you want to allow restoring deleted budgets
    }

    /**
     * Determine whether the user can permanently delete the budget.
     */
    public function forceDelete(User $user, Budget $budget): bool
    {
        return false; // Implement logic if you want to allow permanent deletion
    }
}
