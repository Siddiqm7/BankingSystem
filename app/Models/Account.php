<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

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

    protected static function booted(): void
    {
        static::created(function ($account) {
            Log::info('New account created', [
                'account_id' => $account->id,
                'name' => $account->name,
                'type' => $account->account_type,
            ]);
        });

        static::deleted(function ($account) {
            Log::info('Account deleted', [
                'account_id' => $account->id,
                'name' => $account->name,
            ]);
        });
    }

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