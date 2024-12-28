@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
    <div class="container">
        <h1 class="my-4"></h1>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Banned</option>
                </select>
            </div>
            <div class="form-group">
                <label for="account_type">Account Type</label>
                <select class="form-control" id="account_type" name="account_type">
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="admin">Enterprise</option>
                </select>
            </div>

            <div class="form-group">
                <label for="last_login">Last Login</label>
                <input type="datetime-local" class="form-control" id="last_login" name="last_login" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Return</a>
            </div>
        </form>
    </div>
@endsection
