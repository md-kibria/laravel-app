
{{-- <a href="#!" class="btn btn-primary btn-hover w-100 add-btn" x-data="{}" 
   x-on:click.prevent="$wire.addToCartWithQuantity(document.getElementById('quantity').value)><i
        class="mdi mdi-cart me-1"></i>
    {{ session()->get('lang') === 'ro' ? 'Adaugă in coş' : 'Add To Cart' }}
</a> --}}

<a href="#!" id="cart-btn" class="btn btn-primary btn-hover w-100 add-btn"
   x-data="{
       getSelectedVariations() {
           let selected = [];
           document.querySelectorAll('.variation-option:checked').forEach(el => {
               selected.push({
                   id: parseInt(el.value),
                   name: el.getAttribute('data-name'),
                   type: el.getAttribute('data-type'),
                   price: parseFloat(el.getAttribute('data-price')),
               });
           });
           return selected;
       }
   }"
   {{-- x-on:click.prevent="$wire.call('addToCartWithVariations', getSelectedVariations(), parseInt(document.getElementById('quantity').value))" --}}
   x-on:click.prevent="$wire.addToCartWithVariations(getSelectedVariations(), parseInt(document.getElementById('quantity').value)"
   >
   <i class="mdi mdi-cart me-1"></i>
   {{ session()->get('lang') === 'ro' ? 'Adaugă in coş' : 'Add To Cart' }}
</a>


