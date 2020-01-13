@extends('layouts.index')

@section('title', 'List of Products')
@php
$currencyName = session()->get('currency.name', 'USD');
$currencyRate = session()->get('currency.rate', 1);
@endphp

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
    <ul id = "currency_menu">
        @foreach($currencies as $currency)
            <li class="currency {{ $currency->name == $currencyName ? 'active' : '' }}">
                <a href ="{{ route('currency.set', ['currency' => $currency->name]) }}">{{ $currency->name }}</a>
            </li>
        @endforeach
    </ul>

    <h3>List of Products</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Product name</th>
            <th>Price, {{ $currencyName }}</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ round($product->price * $currencyRate / 100, 2) }}</td>
            </tr>
        @endforeach
    </table>
@endsection
