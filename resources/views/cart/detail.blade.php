@extends('layouts.index')

@section('title', 'Shopping Cart')

@section('content')
    <h3>List of Products</h3>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Product name</th>
            <th>Category</th>
            <th>Price, {{ $currencyName }}</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        @foreach($cart['items'] as $item)
            <tr>
                <td>{{ $item['product']->id }}</td>
                <td>{{ $item['product']->name }}</td>
                <td>{{ $item['product']->category->name }}</td>
                <td>{{ round($item['product']->price * $currencyRate / 100, 2) }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
    <div>Total: {{ round($cart['total'] * $currencyRate / 100, 2) }}, {{ $currencyName }}</div>
@endsection
