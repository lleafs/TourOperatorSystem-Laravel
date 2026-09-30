@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
<div class="container">
    <h1>Create Voucher</h1>

    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="agency_id" class="form-label">Agency</label>
            <div class="d-flex">
                <select class="form-control me-2" id="agency_id" name="agency_id" required>
                    @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                    @endforeach
                </select>

                <!-- Button triggers modal with iframe -->
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#agencyPopup">
                    New
                </button>
            </div>
        </div>

        <!-- Modal with iframe -->
        <div class="modal fade" id="agencyPopup" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <iframe src="{{ route('agencies.create') }}" style="width:100%; height:600px; border:none;"></iframe>
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="code" class="form-label">Voucher Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" id="amount" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="discount">Discount</option>
                <option value="gift">Gift</option>
                <option value="promo">Promo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="issue_date" class="form-label">Issue Date</label>
            <input type="date" class="form-control" id="issue_date" name="issue_date" required>
        </div>
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" class="form-control" id="currency" name="currency" value="CLP" required>
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Customer</label>
            <input type="text" class="form-control" id="customer" name="customer" required>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Voucher</button>
    </form>
</div>
@endsection