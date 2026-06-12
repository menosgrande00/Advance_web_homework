@extends('admin.layouts.app')

@section('page_title', 'Orders')

@section('admin_content')
    <div class="card">
        <div class="card-header">
            <form class="form-inline" action="{{ route('admin.orders.index') }}" method="GET">
                <label class="mr-2" for="status">Status</label>
                <select class="form-control mr-2" id="status" name="status">
                    <option value="">All statuses</option>
                    @foreach (\App\Models\Order::STATUSES as $option)
                        <option value="{{ $option }}" @selected($status === $option)>{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Filter</button>
            </form>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead><tr><th>Order</th><th>Customer</th><th>Date</th><th>Status</th><th>Total</th><th></th></tr></thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->customer_name }}<br><small>{{ $order->user?->email }}</small></td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td><span class="badge badge-info">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ number_format((float) $order->total, 2) }} TL</td>
                        <td class="text-right"><a class="btn btn-sm btn-info" href="{{ route('admin.orders.show', $order) }}"><i class="fas fa-eye"></i> Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No orders found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())<div class="card-footer">{{ $orders->links() }}</div>@endif
    </div>
@endsection
