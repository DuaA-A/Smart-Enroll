@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="welcome-card">
        <div class="profile-header">
            <p class="profile-label">Profile Picture</p>
            <img src="{{ asset($user->user_image) }}"  class="profile-image">
            <h2 class="welcome-title">Welcome, {{ $user->full_name }}!</h2>
        </div>
        <div class="profile-details">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>WhatsApp:</strong> {{ $user->whatsapp_number ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
        </div>
        <a href="{{ route('register') }}" class="btn-primary">Register Another User</a>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .welcome-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        padding: 30px;
        max-width: 500px;
        width: 100%;
        text-align: center;
    }

    .profile-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .profile-label {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px; 
        color: #333;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #28a745;
    }

    .welcome-title {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .profile-details {
        text-align: left;
        font-size: 16px;
        line-height: 1.6;
        color: #555;
    }

    .profile-details p {
        margin: 8px 0;
    }

    .btn-primary {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #218838;
    }

    body {
        background-color: #f7f7f7;
    }
</style>
@endsection
