@extends('admin.dashboard')

@section('content')
<div class="container my-5">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4 text-center">Order History</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No completed orders found.
        </div>
    @else
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Completed Order Details</h3>
        </div>
        <div class="card">
            <div class="card-body"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Order Number</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Items</th>
                                <th scope="col">Completed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>₱{{ number_format($order->total_price, 2) }} pesos</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($order->items as $item)
                                                <li>{{ $item->name }} ({{ $item->pivot->quantity }} pcs)</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $order->completed_at ? $order->completed_at->timezone('Asia/Manila')->format('F j, Y g:i A') : 'Not marked' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
