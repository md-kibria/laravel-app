{{-- {{dd(session()->get('cart'))}} --}}

<div>
<div class="offcanvas offcanvas-end product-list overflow-auto" wire:ignore.self tabindex="-1" id="ecommerceCart" aria-labelledby="ecommerceCartLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="ecommerceCartLabel">{{ session()->get('lang') === 'ro' ? 'Coșul meu' : 'My Cart' }} <span
                class="badge bg-danger align-middle ms-1 cartitem-badge">{{ count($cart) }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div data-simplebar class="h-100">
            <ul class="list-group list-group-flush cartlist">

                @foreach ($cart as $item)
                    <li class="list-group-item product">
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-md" style="height: 100%;">
                                    <div class="avatar-title bg-warning-subtle rounded-3">
                                        <img src="{{ asset('/storage/' . $item['thumbnail']) }}" alt=""
                                            class="avatar-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <a href="#!">
                                    <h5 class="fs-15">{{ $item['name'] }}</h5>
                                </a>
                                <div class="d-flex mb-3 gap-2">
                                    <div class="text-muted fw-medium mb-0">$<span class="product-price">{{ $item['price'] }}</span>
                                    </div>
                                    <div class="vr"></div>
                                    {{-- <span class="text-success fw-medium">In Stock</span> --}}
                                </div>
                                <div class="input-step">
                                    <button type="button" class="minus" wire:click="decreaseQuantity({{ $item['id'] }})">–</button>
                                    <input type="number" class="product-quantity" value="{{$item['quantity']}}" min="0"
                                        max="100" readonly>
                                    <button type="button" class="plus" wire:click="increaseQuantity({{ $item['id'] }})">+</button>
                                </div>
                            </div>
                            <div class="flex-shrink-0 d-flex flex-column justify-content-between align-items-end">
                                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"
                                    data-bs-toggle="modal" data-bs-target="#removeItemModal-{{$item['id']}}" aria-label="Close"><i
                                        class="ri-close-fill fs-16"></i></button>
                                <div class="fw-medium mb-0 fs-16">$<span class="product-line-price">{{(int)$item['price'] * $item['quantity'] }}</span></div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="m-0 fs-16 text-muted">Total:</h6>
            <div class="px-2">
                <h6 class="m-0 fs-16 cart-total">
                    @php
                        $total = 0;
                        
                        foreach($cart as $item) {
                            $total += (int)$item['price'] * $item['quantity'];    
                        }
                    @endphp
                    ${{ number_format($total, 2) }}
                </h6>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-12">
                <a href="/checkout" class="btn btn-info w-100">{{ session()->get('lang') === 'ro' ? 'Continuați la Checkout' : 'Continue to Checkout' }}</a>
            </div>
        </div>
    </div>
</div>

    
@foreach ($cart as $index => $item)
<!-- removeItemModal -->
<div id="removeItemModal-{{$item['id']}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this service?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" data-bs-dismiss="modal" wire:click="removeFromCart({{ $index }})">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach


</div>