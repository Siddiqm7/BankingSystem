@extends('layouts.app')

@section('content')
    <h1>All Accounts</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Account Type</th>
            <th>Status</th>
            <th>Balance</th>
        </tr>
        @foreach($accounts as $account)
        <tr>
            <td>{{ $account['name'] }}</td>
            <td>{{ $account['account_type'] }}</td>
            <td>{{ $account['account_status'] }}</td>
            <td>{{ $account['current_account_balance'] }}</td>
        </tr>
        @endforeach
    </table>
@endsection