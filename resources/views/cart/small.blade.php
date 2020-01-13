@if(session()->get('cart'))
    <div class="p-2 border border-success">Cart has {{ array_sum(session()->get('cart')) }} items. <a href="{{ route('cart.detail') }}">Detail</a></div>
@endif
