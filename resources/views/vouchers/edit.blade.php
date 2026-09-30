@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Voucher</h1>
    <form method="POST" action="{{ route('vouchers.update', $voucher) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="agency_id" class="form-label">Agency</label>
            <select id="agency_id" name="agency_id" class="form-control" required>
                @foreach($agencies as $agency)
                <option value="{{ $agency->id }}"
                    {{ $voucher->agency_id == $agency->id ? 'selected' : '' }}>
                    {{ $agency->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Voucher Code</label>
            <input type="text" id="code" name="code" class="form-control"
                value="{{ $voucher->code }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select id="type" name="type" class="form-control" required>
                <option value="discount" {{ $voucher->type == 'discount' ? 'selected' : '' }}>Discount</option>
                <option value="gift" {{ $voucher->type == 'gift' ? 'selected' : '' }}>Gift</option>
                <option value="promo" {{ $voucher->type == 'promo' ? 'selected' : '' }}>Promo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="issue_date" class="form-label">Issue Date</label>
            <input type="date" id="issue_date" name="issue_date" class="form-control"
                value="{{ $voucher->issue_date }}" required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" id="expiry_date" name="expiry_date" class="form-control"
                value="{{ $voucher->expiry_date }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" id="amount" name="amount" class="form-control"
                value="{{ number_format($voucher->amount, 0, ',', '.') }}" required>
        </div>

        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" id="currency" name="currency" class="form-control"
                value="{{ $voucher->currency }}" required>
        </div>

        <div class="mb-3">
            <label for="customer" class="form-label">Customer</label>
            <input type="text" id="customer" name="customer" class="form-control"
                value="{{ $voucher->customer }}" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea id="notes" name="notes" class="form-control">{{ $voucher->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Voucher</button>
    </form>
</div>
@endsection