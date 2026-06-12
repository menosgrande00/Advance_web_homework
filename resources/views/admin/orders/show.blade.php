@extends('admin.layouts.app')

@section('page_title', 'Order '.$order->order_number)

@section('admin_content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Order Information</h3></div>
                <div class="card-body">
                    <p><strong>Customer:</strong><br>{{ $order->customer_name }}</p>
                    <p><strong>Email:</strong><br>{{ $order->user?->email }}</p>
                    <p><strong>Phone:</strong><br>{{ $order->phone }}</p>
                    <p><strong>Address:</strong><br>{{ $order->address }}</p>
                    <p><strong>Note:</strong><br>{{ $order->note ?: '-' }}</p>
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf @method('PATCH')
                        <label for="status">Status</label>
                        <select class="form-control mb-2" id="status" name="status">
                            @foreach (\App\Models\Order::STATUSES as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary btn-block" type="submit">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr></thead>
                        <tbody>
                        @foreach ($order->items as $item)
                            <tr><td>{{ $item->product_name }}</td><td>{{ number_format((float) $item->unit_price, 2) }} TL</td><td>{{ $item->quantity }}</td><td>{{ number_format((float) $item->subtotal, 2) }} TL</td></tr>
                        @endforeach
                        <tr><th colspan="3">Total</th><th>{{ number_format((float) $order->total, 2) }} TL</th></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
