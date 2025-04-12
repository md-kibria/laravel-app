<section class="position-relative py-5">
    <div class="container">
        <div class="row gy-4 gy-lg-0">
            @foreach ($key_features as $item)
            <div class="col-lg-3 col-sm-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="flex-shrink-0">
                        <img src="{{ $item->image ? asset('/storage/' . $item->image) : '' }}" alt="" class="avatar-sm">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fs-15">{{ $item->getTranslation('title', session()->get('lang')) }}</h5>
                        <p class="text-muted mb-0">{{ $item->getTranslation('description', session()->get('lang')) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>