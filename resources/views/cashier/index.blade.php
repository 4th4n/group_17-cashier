@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Cashier Dashboard</h1>

    {{-- Listahan ng mga order --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Order List</h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p class="text-center">Wala pang order na natanggap.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Number</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>₱{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            @if($order->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status != 'completed')
                                                <form action="{{ route('cashier.complete', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Complete</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('cashier.cancel', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- Order summary --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <h5>Total Amount: ₱{{ number_format($totalAmount, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn {
    font-weight: bold;
}

.table th, .table td {
    text-align: center;
}

.card {
    border-radius: 10px;
}

.card-header {
    background-color: #f8f9fa;
}

    </style>
</div>
@endsection
