@extends('layouts.index')

@section('title', 'List of Products')

<style>
    h3 {
        text-align: center;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-2 offset-10">
            <ul id="currency_menu" class="list-group">
                @foreach($currencies as $name => $rate)
                    <li class="list-group-item {{ $name == $currencyName ? 'active' : '' }}">
                        <a class="{{ $name == $currencyName ? 'text-light' : '' }}" href ="{{ route('currency.set', ['currency' => $name]) }}">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <h3>List of Products</h3>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Product name</th>
            <th>Price, {{ $currencyName }}</th>
            <th>Action</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ round($product->price * $currencyRate / 100, 2) }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.add', ['product' => $product->id]) }}">
                        @csrf
                        <input type="submit" value="+1">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
