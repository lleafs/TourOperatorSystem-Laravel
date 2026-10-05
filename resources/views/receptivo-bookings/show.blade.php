@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Booking #{{ $receptivoBooking->id }}</h5>
            <p><strong>Agency:</strong> {{ $receptivoBooking->agency->name }}</p>
            <p><strong>Booking Date:</strong> {{ $receptivoBooking->booking_date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($receptivoBooking->status) }}</p>
            <p><strong>Hotel:</strong> {{ $receptivoBooking->hotel_name }}</p>
            <p><strong>Check In:</strong> {{ $receptivoBooking->check_in }}</p>
            <p><strong>Check Out:</strong> {{ $receptivoBooking->check_out }}</p>
            <p><strong>Total Amount:</strong> {{ $receptivoBooking->total_amount }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Customers</span>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignCustomerModal">
                Assign Customer
            </button>
        </div>
        <div class="card-body">
            @if($receptivoBooking->customers->isNotEmpty())
            <ul class="list-group" id="customerList">
                @foreach($receptivoBooking->customers as $customer)
                <li class="list-group-item">
                    <span><strong>{{ $customer->full_name }}</strong> — {{ $customer->email }}</span>
                </li>
                @endforeach
            </ul>


            @else
            <ul class="list-group" id="customerList"></ul>
            <p>No customers assigned.</p>
            @endif
        </div>

    </div>

    <div class="mt-3">
        <a href="{{ route('receptivo-bookings.edit', $receptivoBooking) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('receptivo-bookings.index') }}" class="btn btn-secondary">Back to list</a>
    </div>
</div>

<!-- Modal para asignar cliente -->
<div class="modal fade" id="assignCustomerModal" tabindex="-1" aria-labelledby="assignCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="assignCustomerForm" action="{{ route('bookings.assign-customer', $receptivoBooking->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignCustomerModalLabel">Assign Customer to Booking #{{ $receptivoBooking->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Select Customer</label>
                    <select name="customer_id" class="form-control" required>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection