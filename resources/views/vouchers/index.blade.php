@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Vouchers</h1>
    <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">New Voucher</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Issue Date</th>
                <th>Expiry Date</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Customer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->type }}</td>
                    <td>{{ $voucher->issue_date }}</td>
                    <td>{{ $voucher->expiry_date }}</td>
                    <td>{{ number_format($voucher->amount, 0, ',', '.') }}</td>
                    <td>{{ $voucher->currency }}</td>
                    <td>{{ $voucher->customer }}</td>
                    <td>
                        <a href="{{ route('vouchers.show', $voucher) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('vouchers.edit', $voucher) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('vouchers.destroy', $voucher) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No vouchers yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
