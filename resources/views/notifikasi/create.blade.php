@extends('layouts.app')

@section('content')
<div class="notification-form">
    <h2>Create New Notification</h2>
    <form method="POST" action="{{ route('admin.notifications.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Notification Title" required>
        <select name="recipient" required>
            <option value="Pembeli">Pembeli</option>
            <option value="Penjual">Penjual</option>
        </select>
        <textarea name="description" placeholder="Notification Description" required></textarea>
        <button type="submit">Create Notification</button>
    </form>
</div>
@endsection
