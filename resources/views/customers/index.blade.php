@extends('layouts.app')
@section('title', 'CUSTOMER MANAGEMENT')
@section('content')
<div class="container-xl">
    <h1 class="my-4"></h1>
    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('customers.create') }}" class="btn btn-success"><i class="bi bi-person-plus"></i> <span>ADD CUSTOMER</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Account_type</th>
                        <th>Last_login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $index => $customer)
                    <tr>
                        <!-- Tính thứ tự: (Trang hiện tại - 1) * Số bản ghi mỗi trang + chỉ số trong trang + 1 -->
                        <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->status }}</td>
                        <td>{{ $customer->account_type }}</td>
                        <td>{{ $customer->last_login }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                            </a>

                            <a href="#deleteCustomerModal{{ $customer->id }}" class="btn btn-danger btn-sm" data-bs-toggle="modal" title="Delete">
                                <i class="bi bi-trash" style="font-size: 20px;"></i>
                            </a>

                            <div id="deleteCustomerModal{{ $customer->id }}" class="modal fade" tabindex="-1" aria-labelledby="deleteCustomerModalLabel{{ $customer->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="deleteCustomerModalLabel{{ $customer->id }}">Confirm Deletion</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this customer?</p>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection