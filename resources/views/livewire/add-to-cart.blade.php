
<a href="#!" class="btn btn-primary btn-hover w-100 add-btn" x-data="{}" 
   x-on:click.prevent="$wire.addToCartWithQuantity(document.getElementById('quantity').value)><i
        class="mdi mdi-cart me-1"></i>
    {{ session()->get('lang') === 'ro' ? 'Adaugă in coş' : 'Add To Cart' }}
</a>
