@extends('layouts.app')

@section('title', 'Order List')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center mb-4">
        <img src="{{ URL('images/checklist.png') }}" class="img-fluid mr-3" width="50" height="50" alt="Contact List Image">
        <h1 class="" style="color: #052415;">Order list</h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="col-12">
        <form action="{{ route('orders.index') }}" method="get" class="mb-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search by name" name="search"
                            value="{{ old('search', request('search')) }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3 d-flex">
                    <!-- Dropdown for Status Tabs -->
                    <div class="input-group" style="width: 70%; margin-left: 10px;">
                        <select class="form-select" id="statusFilter" name="status">
                            <option value="" disabled selected>Filter by Status</option>
                            <option value="all" {{ old('status', request('status')) == 'all' ? 'selected' : '' }}>All
                            </option>
                            <option value="ACTIVE" {{ old('status', request('status')) == 'ACTIVE' ? 'selected' : '' }}>
                                Active</option>
                            <option value="INACTIVE"
                                {{ old('status', request('status')) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="ml-auto mr-5">
                        <button class="btn btn-outline " style="background-color: #fcc80a;" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach ($orders as $order)
            <div class="col-sm-6 col-md-4 col-lg-3 brand-card" style="margin-bottom: 20px;">
                <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $order->id }}">
                    <div class="card @if($order->status == 'INACTIVE') bg-danger @endif">
                        <div class="card-body text-center">
                            <span class="material-symbols-outlined">
                                Verified
                            </span>
                            <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $order->user->name }}</a></h4>
                            <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $order->reference }}</a></h4>
                            <p></p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- View Modal for each order -->
            <div class="modal fade" id="viewModal{{ $order->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Details - ID: {{ $order->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Display order details here -->
                            <dl class="row">
                                <dt class="col-sm-3">ID:</dt>
                                <dd class="col-sm-9">{{ $order->id }}</dd>
                                <dt class="col-sm-3">User:</dt>
                                <dd class="col-sm-9">{{ $order->user->name }}</dd>
                                <dt class="col-sm-3">Reference:</dt>
                                <dd class="col-sm-9">{{ $order->reference }}</dd>
                                <dt class="col-sm-3">Phone:</dt>
                                <dd class="col-sm-9">{{ $order->user->phone }}</dd>
                                <dt class="col-sm-3">Address:</dt>
                                <dd class="col-sm-9">{{ $order->address->line_1 }}, {{ $order->address->line_2 }}</dd>
                                <dt class="col-sm-3">Status:</dt>
                                <dd class="col-sm-9">{{ $order->status }}</dd>
                            </dl>

                            <!-- Product Details Section -->
                            <h2>Product Details</h2>
                            @forelse ($order->details as $detail)
                                <div class="mb-3">
                                    <strong>Product Name:</strong> {{ $detail->product->name }}<br>
                                    <strong>Brand:</strong> {{ $detail->product->brand->name ?? 'N/A' }}<br>
                                    <strong>Category:</strong> {{ $detail->product->category->name ?? 'N/A' }}<br>
                                    <strong>Quantity:</strong> {{ $detail->quantity }}<br>
                                    <strong>Deal Price:</strong> {{ $detail->deal_price }}<br>
                                </div>
                            @empty
                                <p>No product details available for this order.</p>
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- JavaScript to handle edit button click -->
<script>
    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var orderId = $(this).data('id');
            $('#viewModal' + orderId).modal('hide'); // Hide view modal
            $('#editModal' + orderId).modal('show'); // Show edit modal
        });
    });
</script>
@endsection
