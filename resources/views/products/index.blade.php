
@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <form action="{{ route('products.index') }}" method="GET" class="form-inline" id="searchForm">
            <input type="text" name="search" class="form-control" placeholder="Search by Product ID or Name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr style="background-color: green; color: white;">
                <th>Image</th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'product_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Product ID
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                    </a>
                </th>
                <th>Description</th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Price
                    </a>
                </th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection



