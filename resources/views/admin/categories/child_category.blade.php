<li>{{ $child_category->name }}</li>
@if ($child_category->children->isNotEmpty())
    <ul>
        @foreach ($child_category->children as $childCategory)
            @include('admin.categories.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
