@extends('layouts.admin.master')
@section('title')
    Discount Rules
@endsection
@section('css')
    <!-- extra css -->
    <!-- Sweet Alert css-->
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <x-breadcrumb title="Discount" pagetitle="Dashboard" />

    <form action="/admin/discounts" class="needs-validation" enctype="multipart/form-data" method="POST">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-9 col-lg-8">


                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-light text-primary fs-20">
                                        <i class="bi bi-question"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Add Discount</h5>
                                <p class="text-muted mb-0">Fill all information below.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">Discount Value</label>
                                    <input type="text" class="form-control @error('value') is-invalid @enderror"
                                        id="manufacturer-name-input" placeholder="Enter discount value" name="value"
                                        value="{{ old('value') }}">
                                    @error('value')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-brand-input">Discount Type</label>
                                    <select name="type" id="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="percentage" @selected(true)>Percentage</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Service</label>
                                    <select name="service_id" id="service_id"
                                        class="form-control @error('service_id') is-invalid @enderror">
                                        <option value="">Select Service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Variation Type</label>
                                    <select name="variation_type_id" id="variation_type_id"
                                        class="form-control @error('variation_type_id') is-invalid @enderror">
                                        <option value="">Select Variation Type</option>
                                    </select>
                                    @error('variation_type_id')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Variation</label>
                                    <select name="variation_id" id="variation_id"
                                        class="form-control @error('variation_id') is-invalid @enderror">
                                        <option value="">Select Variation</option>
                                    </select>
                                    @error('variation_id')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            

                        </div>
                        <!-- end row -->

                    </div>
                </div>

                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>

    <!-- JS to update variation options -->
    <script>
        const services = @json($services);
    
        const serviceSelect = document.getElementById('service_id');
        const variationTypeSelect = document.getElementById('variation_type_id');
        const variationSelect = document.getElementById('variation_id');
    
        serviceSelect.addEventListener('change', function () {
            const serviceId = this.value;
    
            // Clear old options
            variationTypeSelect.innerHTML = '<option value="">Select Variation Type</option>';
            variationSelect.innerHTML = '<option value="">Select Variation</option>';
    
            if (serviceId) {
                const selectedService = services.find(s => s.id == serviceId);
    
                if (selectedService && selectedService.variation_types) {
                    selectedService.variation_types.forEach(variationType => {
                        const option = document.createElement('option');
                        option.value = variationType.id;
                        option.text = variationType.name['en'];
                        variationTypeSelect.appendChild(option);
                    });
                }
            }
        });
    
        variationTypeSelect.addEventListener('change', function () {
            const variationTypeId = this.value;
    
            // Clear old variations
            variationSelect.innerHTML = '<option value="">Select Variation</option>';
    
            // Find the selected variation type under the selected service
            const selectedServiceId = serviceSelect.value;
            const selectedService = services.find(s => s.id == selectedServiceId);
    
            if (selectedService && selectedService.variation_types) {
                const selectedVariationType = selectedService.variation_types.find(vt => vt.id == variationTypeId);
                if (selectedVariationType && selectedVariationType.variations) {
                    selectedVariationType.variations.forEach(variation => {
                        const option = document.createElement('option');
                        option.value = variation.id;
                        option.text = variation.name;
                        variationSelect.appendChild(option);
                    });
                }
            }
        });
    </script>
    
    <!--end row-->

    <div class="row" id="orderList">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Variation Type</th>
                                    <th scope="col">Variation</th>
                                    <th scope="col"><span class="text-center d-block">
                                        Status
                                    </span>
                                    <th scope="col"><span class="text-center d-block">
                                        Action
                                    </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discountRules as $discount)
                                <tr>
                                    <td><a class="fw-semibold">#{{$discount->id}}</a></td>
                                    <td>{{ $discount->value }}</td>
                                    <td class="text-capitalize">{{ $discount->type }}</td>
                                    <td class="text-capitalize"><a class="fw-semibold" href="/{{$discount->service->slug}}" target="_blank">{{ $discount->service->getTranslation('name', 'en') }}</a></td>
                                    <td class="text-capitalize">{{ $discount->variationType->getTranslation('name', 'en') }}</td>
                                    <td class="text-capitalize">{{ $discount->variation->name }}</td>
                                    <td class="status text-center">
                                        <span class="badge @if ($discount->status == 'active') bg-success-subtle text-success @else bg-danger-subtle text-danger @endif text-uppercase">{{$discount->status}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#delteModal-{{$discount->id}}" data-bs-toggle="modal" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if (count($discountRules) === 0)
                        <div class="noresult">
                            <div class="text-center py-4">
                                <div class="avatar-md mx-auto mb-4">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- <div class="d-flex justify-content-between align-items-center pt-2">
                        <p class="text-muted mb-0">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
                        </p>
                        {{ $orders->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <!-- delteModal -->
    @foreach ($discountRules as $discount)
    <div id="delteModal-{{$discount->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="close-removecategoryModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-15">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this discount?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/discounts/{{$discount->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn w-sm btn-light btn-hover"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn w-sm btn-danger btn-hover" id="remove-category">Yes, Delete
                            It!</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
@section('scripts')
    <!-- list.js min js -->
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- <script src="{{ URL::asset('build/js/backend/order-list.init.js') }}"></script> --}}
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
