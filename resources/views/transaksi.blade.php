@extends('layouts.app')

@section('content')
<div class="transaction-history">
    <h2>Transaction History</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->user->name }}</td>
                    <td>${{ $transaction->amount }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
