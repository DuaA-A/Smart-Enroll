@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="container">
        <h2>Welcome, {{ $user->full_name }}!</h2>
        <div class="profile">
            <img src="{{ asset($user->user_image) }}" alt="Profile Picture" class="profile-image">
            <div class="profile-details">
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>WhatsApp:</strong> {{ $user->whatsapp_number }}</p>
                <p><strong>Address:</strong> {{ $user->address }}</p>
            </div>
        </div>
        <a href="{{ route('register') }}" class="btn">Register Another User</a>
    </div>
</div>

<style>
    .profile {
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .profile-image {
        max-width: 150px;
        border-radius: 50%;
    }
    .profile-details {
        font-size: 16px;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
    }
    .btn:hover {
        background-color: #218838;
    }
</style>
@endsection