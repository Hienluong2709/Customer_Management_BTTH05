@extends('layouts.app')

@section('title', 'EDIT CUSTOMER')

@section('content')
    <div class="container">
        <h1>Edit Customer Information</h1>
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="email"><b>Email:</b></label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="password"><b>Password (leave blank to keep current password):</b></label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group mb-3">
                <label for="status"><b>Account Status:</b></label>
                <select class="form-control" id="status" name="status">
                    <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="banned" {{ $customer->status == 'banned' ? 'selected' : '' }}>Banned</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="account_type"><b>Account Type:</b></label>
                <select class="form-control" id="account_type" name="account_type">
                    <option value="basic" {{ $customer->account_type == 'basic' ? 'selected' : '' }}>Basic</option>
                    <option value="premium" {{ $customer->account_type == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="enterprise" {{ $customer->account_type == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="last_login"><b>Last Login Time:</b></label>
                <input type="datetime-local" class="form-control" id="last_login" name="last_login" value="{{ old('last_login', $customer->last_login ? \Carbon\Carbon::parse($customer->last_login)->format('Y-m-d\TH:i') : '') }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left-circle-fill"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection
