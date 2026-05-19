@extends('layouts.app')

@section('content')
    <h1>Account Details</h1>
    @if($account)
        <p>Name: {{ $account['name'] }}</p>
        <p>Type: {{ $account['account_type'] }}</p>
        <p>Status: {{ $account['account_status'] }}</p>
        <p>Balance: {{ $account['current_account_balance'] }}</p>
    @else
        <p>Account not found!</p>
    @endif
@endsection