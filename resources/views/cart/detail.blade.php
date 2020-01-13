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
            <th></th>
            <th></th>
        </tr>
        @foreach($cart['items'] as $item)
            <tr>
                <td>{{ $item['product']->id }}</td>
                <td>{{ $item['product']->name }}</td>
                <td>{{ $item['product']->category->name }}</td>
                <td>{{ round($item['product']->price * $currencyRate / 100, 2) }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.remove', ['product' => $item['product']->id]) . '?quantity=1' }}">
                        @csrf
                        @method('PUT')
                        <input type="submit" value="-1">
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('cart.remove', ['product' => $item['product']->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="submit" value="Remove">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div>Total: {{ round($cart['total'] * $currencyRate / 100, 2) }}, {{ $currencyName }}</div>

    <form method="POST" action="{{ route('cart.clear') }}">
        @csrf
        @method('DELETE')
        <input type="submit" value="Clear Cart">
    </form>
@endsection
