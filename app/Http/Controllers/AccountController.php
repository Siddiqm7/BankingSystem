<?php

namespace App\Http\Controllers;

use App\Interfaces\AccountServiceInterface;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(
        private AccountServiceInterface $accountService
    ) {}

    public function index()
    {
        $accounts = $this->accountService->getAllAccounts();
        return view('accounts.index', compact('accounts'));
    }

    public function show($id)
    {
        $account = $this->accountService->getAccountById($id);
        return view('accounts.show', compact('account'));
    }

    public function store(Request $request)
    {
        $result = $this->accountService->createNewAccount($request->all());
        return $result
            ? redirect('/accounts')->with('success', 'Account created!')
            : back()->with('error', 'Something went wrong!');
    }

    public function update(Request $request, $id)
    {
        $result = $this->accountService->updateAccount($id, $request->all());
        return $result
            ? redirect('/accounts')->with('success', 'Account updated!')
            : back()->with('error', 'Something went wrong!');
    }

    public function destroy($id)
    {
        $result = $this->accountService->deleteAccount($id);
        return $result
            ? redirect('/accounts')->with('success', 'Account deleted!')
            : back()->with('error', 'Something went wrong!');
    }

    public function renew($id)
    {
        $result = $this->accountService->renewOldAccount($id, []);
        return $result
            ? redirect('/accounts')->with('success', 'Account renewed!')
            : back()->with('error', 'Account is already active!');
    }
}