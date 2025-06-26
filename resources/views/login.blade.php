@extends('layouts.app')

@section('content')
  <div class="login-form">
    <h2>Welcome, Log into FoodCycle for Admin</h2>
    <form method="POST" action="{{ route('admin.login') }}">
      @csrf
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
@endsection
