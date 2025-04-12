<!-- Success Alert -->
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="position: fixed; bottom: 20px; right: 20px; width: auto; max-width: 300px; z-index: 1050;"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Error Alert -->
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="position: fixed; bottom: 20px; right: 20px; width: auto; max-width: 300px; z-index: 1050;"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
