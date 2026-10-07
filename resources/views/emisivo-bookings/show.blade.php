@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Emisivo Booking Details</h1>

<div style="font-family: Arial, sans-serif; font-size: 12pt; line-height: 1.4;">
    <h2 style="text-align: center; margin-bottom: 20px;">
        Booking #{{ $emisivoBooking->id }}
    </h2>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 30%; font-weight: bold;">Agency:</td>
            <td>{{ $emisivoBooking->agency?->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Booking Date:</td>
            <td>{{ $emisivoBooking->booking_date }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Status:</td>
            <td>{{ ucfirst($emisivoBooking->status) }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Customer:</td>
            <td>{{ $emisivoBooking->customer_name }} ({{ $emisivoBooking->customer_email }})</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Departure Country:</td>
            <td>{{ $emisivoBooking->departureCountry?->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Departure City:</td>
            <td>{{ $emisivoBooking->departureCity?->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Airport:</td>
            <td>{{ $emisivoBooking->airport?->name }}</td>
        </tr>
        @if($emisivoBooking->departureFlight)
        <tr>
            <td style="font-weight: bold;">Flight Number:</td>
            <td>{{ $emisivoBooking->departureFlight->flight_number }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Route:</td>
            <td>{{ $emisivoBooking->departureFlight->origin }} → {{ $emisivoBooking->departureFlight->destination }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Scheduled Time:</td>
            <td>{{ $emisivoBooking->departureFlight->scheduled_time->format('d M Y, H:i') }}</td>
        </tr>
        @endif
        <tr>
            <td style="font-weight: bold;">Notes:</td>
            <td>{{ $emisivoBooking->notes ?? 'None' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total Amount:</td>
            <td>{{ 'CLP ' . number_format($emisivoBooking->total_amount, 0, ',', '.') }}</td>
        </tr>
    </table>
</div>



    <a href="{{ route('emisivo-bookings.edit', $emisivoBooking) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('emisivo-bookings.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection