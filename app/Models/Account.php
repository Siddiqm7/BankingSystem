<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'gender',
        'account_type',
        'account_opening_date',
        'account_status',
        'account_number',
        'current_account_balance',
        'savings_account_balance',
        'address',
        'phone',
        'email',
    ]; 
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('account_status', 'active');
    }

    #[Scope]
    protected function inactive(Builder $query): void
    {
        $query->where('account_status', 'inactive');
    }
}