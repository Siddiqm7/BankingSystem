<?php

namespace App\Services;

use App\Interfaces\AccountServiceInterface;
use App\Models\Account;
use Illuminate\Support\Facades\DB; // FIXED: Imported the DB facade

class AccountService implements AccountServiceInterface
{
    public function createNewAccount(array $data): bool
    {
        $account = Account::create($data);
        return $account ? true : false;
    }

    // FIXED: Added strict 'int' type hint to match Interface
    public function getAccountById(int $id): ?array
    {
        $getaccount = Account::find($id);
        return $getaccount ? $getaccount->toArray() : null;
    }

    // FIXED: Added strict 'int' type hint to match Interface
    public function updateAccount(int $id, array $data): bool
    {
        $account = Account::find($id);
        return $account ? $account->update($data) : false;
    }

    public function renewOldAccount(int $id, array $data): bool
    {
        $account = Account::find($id);

        if (!$account) {
            return false; // account not found
        }

        if ($account->account_status === 'inactive') {
            // FIXED: Ensure the database update safely handles the state change array merge
            $data['account_status'] = 'active'; 
            return $account->update($data);
        }
        
        return false; // account already active
    }

    // FIXED: Added strict 'int' type hint to match Interface
    public function deleteAccount(int $id): bool
    {
        $account = Account::find($id);
        if ($account) {
            $account->delete();
            return true;
        }
        return false;
    }

    // FIXED: Added strict 'int' type hint to match Interface
    public function sendEmail(int $id): void
    {
        // todo: send email to account holder
        // Mail::to($account->email)->send(new AccountMail($account));
    }

    // FIXED: Added strict 'int' type hint and applied row locking for financial safety
    public function takeSmsCharge(int $id): void
    {
        DB::transaction(function () use ($id) {
            $account = Account::lockForUpdate()->find($id);
            if ($account) {
                if ($account->account_type === 'current') {
                    $account->current_account_balance -= 10.00;
                } else {
                    $account->savings_account_balance -= 5.00;
                }
                $account->save();
            }
        });
    }

    // FIXED: Added locking mechanism to prevent race conditions during updates
    public function deposit(int $id, float $amount): bool
    {
        return DB::transaction(function () use ($id, $amount) {
            $account = Account::lockForUpdate()->find($id);
            
            if (!$account) {
                return false;
            }
            
            if ($account->account_type === 'current') {
                $account->current_account_balance += $amount;
            } else {
                $account->savings_account_balance += $amount;
            }
            
            return $account->save();
        });
    }

    public function withdraw(int $id, float $amount): bool
    {
        return DB::transaction(function () use ($id, $amount) {
            $account = Account::lockForUpdate()->find($id);
            
            if (!$account) {
                return false;
            }

            if ($account->account_type === 'current') {
                if ($account->current_account_balance < $amount) {
                    return false; // insufficient balance
                }
                $account->current_account_balance -= $amount; 
            } else {
                if ($account->savings_account_balance < $amount) {
                    return false; // insufficient balance
                }
                $account->savings_account_balance -= $amount;
            }

            return $account->save();
        });
    }

    public function getAllAccounts(): array
    {
        return Account::all()->toArray();
    }
}