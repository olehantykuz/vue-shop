@extends('admin.index')

@section('title', 'List of Categories')

@section('content')
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
            <ul>
                @foreach ($category->children as $childCategory)
                    @include('admin.categories.child_category', ['child_category' => $childCategory])
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
