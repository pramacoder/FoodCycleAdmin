@extends('layouts.app')

@section('content')
  <div class="dashboard">
    @include('components.sidebar')
    <div class="dashboard-content">
      <h2>Welcome to Admin Dashboard</h2>
      <div class="stats">
        <!-- Show stats or tables of users, transactions, etc. -->
      </div>
    </div>
  </div>
@endsection
