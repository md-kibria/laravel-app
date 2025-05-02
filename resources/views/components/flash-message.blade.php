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

<script>
    Livewire.on('showSuccessToast', message => {
        // Create alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show';
        alertDiv.setAttribute('role', 'alert');
        alertDiv.style.position = 'fixed';
        alertDiv.style.bottom = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.width = 'auto';
        alertDiv.style.maxWidth = '300px';
        alertDiv.style.zIndex = '1050';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        document.body.appendChild(alertDiv);

        // Auto-remove after 3 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    });
</script> 