@extends('admin.index')

@section('title', 'List of Products')

<style>
    table {
        width: 50%;
    }
    td {
        text-align: center;
        border: 1px solid grey;
    }
</style>

@section('content')
    <h3>List of Products</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Product name</th>
            <th>Price, $</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price / 100 }}</td>
            </tr>
        @endforeach
    </table>
@endsection
