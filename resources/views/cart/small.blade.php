@if(session()->get('cart'))
    <div>Cart has {{ array_sum(session()->get('cart')) }} items. <a href="#">Detail</a></div>
@endif
