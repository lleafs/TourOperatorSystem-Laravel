@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voucher Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Code:</strong> {{ $voucher->code }}</li>
        <li class="list-group-item"><strong>Type:</strong> {{ $voucher->type }}</li>
        <li class="list-group-item"><strong>Issue Date:</strong> {{ $voucher->issue_date }}</li>
        <li class="list-group-item"><strong>Expiry Date:</strong> {{ $voucher->expiry_date }}</li>
        <li class="list-group-item"><strong>Amount:</strong> {{ number_format($voucher->amount, 0, ',', '.') }} {{ $voucher->currency }}</li>
        <li class="list-group-item"><strong>Customer:</strong> {{ $voucher->customer }}</li>
        <li class="list-group-item"><strong>Notes:</strong> {{ $voucher->notes }}</li>
    </ul>
    <a href="{{ route('vouchers.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
