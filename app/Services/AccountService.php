<?php
namespace App\Services;
use App\Interfaces\AccountServiceInterface;
use App\Models\Account;
class AccountService implements AccountServiceInterface
{
    public function createNewAccount(array $data): bool
    {
        $account = Account::create($data);
        return $account ? true : false;
    }

    public function getAccountById($id): ?array
    {
        $getaccount = Account::find($id);
        return $getaccount ? $getaccount->toArray() : null;

    }

    public function updateAccount($id, array $data): bool
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
        $account->account_status = 'active'; // reactivate
        $account->update($data);
        return true;
    }
    
    return false; // account already active
}

    public function deleteAccount($id): bool
    {
        $account = Account::find($id);
        if ($account) {
            $account->delete();
            return true;
        }
        return false;
    }

       public function sendEmail($id): void
    {
    // todo: send email to account holder
    // Mail::to($account->email)->send(new AccountMail($account));
    }

    public function takeSmsCharge($id): void
   {
    $account = Account::find($id);
    if ($account) {
        if ($account->account_type === 'current') {
            $account->current_account_balance -= 10.00;
        } else {
            $account->savings_account_balance -= 5.00;
        }
        $account->save();
    }
   }
}
