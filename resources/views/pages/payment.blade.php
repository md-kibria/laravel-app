@extends('layouts.master')
@section('title')
    Payment
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <section class="page-wrapper bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center d-flex align-items-center justify-content-between">
                        <h4 class="text-white mb-0">{{ session()->get('lang') === 'ro' ? 'Plată' : 'Payment' }}</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-light justify-content-center mb-0 fs-15">
                                <li class="breadcrumb-item"><a
                                        href="/services">{{ session()->get('lang') === 'ro' ? 'Servicii' : 'Services' }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="/checkout">Checkout</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ session()->get('lang') === 'ro' ? 'Plată' : 'Payment' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

    <section class="section pb-4">
        <div class="container">
            <div class="row product-list">
                <div class="col-xl-8 mx-auto">
                    <h5 class="mb-0 flex-grow-1">
                        {{ session()->get('lang') === 'ro' ? 'Selectarea plății' : 'Payment Selection' }}</h5>

                    <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3 mt-4 nav-justified custom-nav"
                        role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active py-3" data-bs-toggle="tab" href="#credit" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-bank-card-fill align-bottom"></i></span>
                                <span class="d-sm-block"> <i class="ri-bank-card-fill align-bottom pe-2"></i>
                                    Stripe</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link py-3" data-bs-toggle="tab" href="#netopia" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-wallet-fill align-bottom"></i></span>
                                <span class="d-sm-block"><i class="ri-wallet-fill align-bottom pe-2"></i>Netopia</span>
                            </a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">

                        <div class="tab-pane active" id="credit" role="tabpanel">
                            <div class="card">
                                <form class="card-body" action="/checkout/stripe" method="post" id="stripeForm">
                                    @csrf

                                    <h4>{{ session()->get('lang') === 'ro' ? 'Informații de plată' : 'Payment Info' }}
                                    </h4>
                                    <hr>
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <label for="type"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Tipul de client' : 'Customer Type' }}</label>
                                            <select name="s-type" id="s-type"
                                                class="form-control @error('s-type') is-invalid @enderror">
                                                <option value="person" @selected(true)>
                                                    {{ session()->get('lang') === 'ro' ? 'Persoană' : 'Person' }}</option>
                                                <option value="firm">
                                                    {{ session()->get('lang') === 'ro' ? 'Firmă/Companie' : 'Firm/Company' }}
                                                </option>
                                            </select>
                                            @error('s-type')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row gy-3" id="s-firm" style="display: none;">
                                            <div class="col-md-12">
                                                <label for="company"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numele companiei' : 'Company Name' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-company') is-invalid @enderror"
                                                    id="company"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele companiei dvs.' : 'Enter your company name' }}"
                                                    name="s-company" value="{{ old('s-company') }}" required>
                                                @error('s-company')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="vat"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'CUI' : 'VAT Number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-vat') is-invalid @enderror" id="vat"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți codul TVA al companiei' : 'Enter company vat number' }}"
                                                    name="s-vat" value="{{ old('s-vat') }}" required>
                                                @error('s-vat')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="trade"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numărul de înregistrare la Registrul Comerțului' : 'Trade Register registration number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-trade') is-invalid @enderror"
                                                    id="trade"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numărul de înregistrare la registrul comerțului' : 'Enter trade register registration number' }}"
                                                    name="s-trade" value="{{ old('s-trade') }}" required>
                                                @error('s-trade')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <hr>
                                        </div>

                                        <script>
                                            // document.getElementById('s-type').addEventListener('change', function () {
                                            //     const firmSection = document.getElementById('s-firm');
                                            //     if (this.value === 'firm') {
                                            //         firmSection.style.display = 'flex';
                                            //     } else {
                                            //         firmSection.style.display = 'none';
                                            //     }
                                            // });

                                            document.getElementById('s-type').addEventListener('change', function() {
                                                const firmSection = document.getElementById('s-firm');
                                                const isFirm = this.value === 'firm';

                                                firmSection.style.display = isFirm ? 'flex' : 'none';

                                                // Select all inputs inside the firm section
                                                const firmInputs = firmSection.querySelectorAll('input');

                                                firmInputs.forEach(input => {
                                                    if (isFirm) {
                                                        input.setAttribute('required', 'required');
                                                    } else {
                                                        input.removeAttribute('required');
                                                    }
                                                });
                                            });

                                            // Trigger the change event on page load to handle default selection
                                            document.getElementById('s-type').dispatchEvent(new Event('change'));
                                        </script>

                                        <div class="col-md-6">
                                            <label for="name"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Nume' : 'Name' }}</label>
                                            <input type="text" class="form-control @error('s-name') is-invalid @enderror"
                                                id="name"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele dvs' : 'Enter your name' }}"
                                                name="s-name" value="{{ old('s-name') ?? Auth::user()?->name }}" required>
                                            @error('s-name')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nid"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'CNP' : 'National ID number' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-nid') is-invalid @enderror" id="nid"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți NID-ul' : 'Enter your nid' }}"
                                                name="s-nid" value="{{ old('s-nid') }}">
                                            @error('s-nid')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Adresa' : 'Address' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-address') is-invalid @enderror"
                                                id="address"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introdu adresa ta' : 'Enter your address' }}"
                                                name="s-address" value="{{ old('s-address') }}" required>
                                            @error('s-address')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Oraş' : 'City' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-city') is-invalid @enderror" id="city"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți orașul dvs.' : 'Enter your city' }}"
                                                name="s-city" value="{{ old('s-city') ?? Auth::user()?->city }}"
                                                required>
                                            @error('s-city')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="county"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Județ' : 'County' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-county') is-invalid @enderror"
                                                id="county"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți județul dvs.' : 'Enter your county' }}"
                                                name="s-county" value="{{ old('s-county') ?? Auth::user()?->county }}"
                                                required>
                                            @error('s-county')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="country"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Ţară' : 'Country' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-country') is-invalid @enderror"
                                                id="country"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți țara dvs.' : 'Enter your country' }}"
                                                name="s-country" value="Romania"
                                                required disabled>
                                            @error('s-country')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="buyers-address"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'E-mail' : 'Email' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-email') is-invalid @enderror"
                                                id="buyers-address"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți adresa dvs. de e-mail' : 'Enter your email' }}"
                                                name="s-email" value="{{ old('s-email') ?? Auth::user()?->email }}"
                                                required>
                                            @error('s-email')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="buyers-phone"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Telefon' : 'Phone' }}</label>
                                            <input type="text"
                                                class="form-control @error('s-phone') is-invalid @enderror"
                                                id="buyers-phone"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți telefonul dvs' : 'Enter your phone' }}"
                                                name="s-phone" value="{{ old('s-phone') ?? Auth::user()?->phone }}"
                                                required>
                                            @error('s-phone')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>


                                    <input type="hidden" name="service_id" value="{{ request('id') }}">

                                    <div class="hstack gap-2 justify-content-end pt-4">

                                        <button type="submit"
                                            class="btn btn-hover w-md btn-primary">{{ session()->get('lang') === 'ro' ? 'Plătește cu Stripe' : 'Pay With Stripe' }}<i
                                                class="ri-logout-box-r-line align-bottom ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane" id="netopia" role="tabpanel">
                            <div class="card">
                                <form class="card-body" action="/checkout/netopia" method="post" id="netopiaForm">
                                    @csrf
                                    @auth
                                        {{-- <p class="form-label"><i class="ri-information-line align-bottom ms-2"></i>
                                            {{ session()->get('lang') === 'ro' ? 'Finalizați plata pentru a vă confirma comanda' : 'Complete payment to confirm your order' }}
                                        </p> --}}
                                    @endauth
                                    <h4>{{ session()->get('lang') === 'ro' ? 'Informații de plată' : 'Payment Info' }}
                                    </h4>
                                    <hr>
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <label for="type"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Tipul de client' : 'Customer Type' }}</label>
                                            <select name="n-type" id="n-type"
                                                class="form-control @error('n-type') is-invalid @enderror">
                                                <option value="person" @selected(true)>
                                                    {{ session()->get('lang') === 'ro' ? 'Persoană' : 'Person' }}</option>
                                                <option value="firm">
                                                    {{ session()->get('lang') === 'ro' ? 'Firmă/Companie' : 'Firm/Company' }}
                                                </option>
                                            </select>
                                            @error('n-type')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row gy-3" id="n-firm" style="display: none;">
                                            <div class="col-md-12">
                                                <label for="company"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numele companiei' : 'Company Name' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-company') is-invalid @enderror"
                                                    id="company"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele companiei dvs.' : 'Enter your company name' }}"
                                                    name="s-company" value="{{ old('s-company') }}" required>
                                                @error('s-company')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="vat"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'CUI' : 'VAT Number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-vat') is-invalid @enderror"
                                                    id="vat"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți codul TVA al companiei' : 'Enter company vat number' }}"
                                                    name="s-vat" value="{{ old('s-vat') }}" required>
                                                @error('s-vat')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="trade"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numărul de înregistrare la Registrul Comerțului' : 'Trade Register registration number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-trade') is-invalid @enderror"
                                                    id="trade"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numărul de înregistrare la registrul comerțului' : 'Enter trade register registration number' }}"
                                                    name="s-trade" value="{{ old('s-trade') }}" required>
                                                @error('s-trade')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <hr>
                                        </div>

                                        <script>
                                            document.getElementById('n-type').addEventListener('change', function() {
                                                const firmSection = document.getElementById('n-firm');
                                                const isFirm = this.value === 'firm';

                                                firmSection.style.display = isFirm ? 'flex' : 'none';

                                                // Select all inputs inside the firm section
                                                const firmInputs = firmSection.querySelectorAll('input');

                                                firmInputs.forEach(input => {
                                                    if (isFirm) {
                                                        input.setAttribute('required', 'required');
                                                    } else {
                                                        input.removeAttribute('required');
                                                    }
                                                });
                                            });

                                            // Trigger the change event on page load to handle default selection
                                            document.getElementById('n-type').dispatchEvent(new Event('change'));
                                        </script>

                                        <div class="col-md-6">
                                            <label for="name"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Nume' : 'Name' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-name') is-invalid @enderror" id="name"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele dvs' : 'Enter your name' }}"
                                                name="n-name" value="{{ old('n-name') ?? Auth::user()?->name }}"
                                                required>
                                            @error('n-name')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nid"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'CNP' : 'National ID number' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-nid') is-invalid @enderror" id="nid"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți NID-ul' : 'Enter your nid' }}"
                                                name="n-nid" value="{{ old('n-nid') }}">
                                            @error('n-nid')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Adresa' : 'Address' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-address') is-invalid @enderror"
                                                id="address"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introdu adresa ta' : 'Enter your address' }}"
                                                name="n-address" value="{{ old('n-address') }}" required>
                                            @error('n-address')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Oraş' : 'City' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-city') is-invalid @enderror" id="city"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți orașul dvs.' : 'Enter your city' }}"
                                                name="n-city" value="{{ old('n-city') ?? Auth::user()?->city }}"
                                                required>
                                            @error('n-city')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="county"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Județ' : 'County' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-county') is-invalid @enderror"
                                                id="county"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți județul dvs.' : 'Enter your county' }}"
                                                name="n-county" value="{{ old('n-county') ?? Auth::user()?->county }}"
                                                required>
                                            @error('n-county')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="country"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Ţară' : 'Country' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-country') is-invalid @enderror"
                                                id="country"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți țara dvs.' : 'Enter your country' }}"
                                                name="n-country" value="Romania"
                                                required disabled>
                                            @error('n-country')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="buyers-address"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'E-mail' : 'Email' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-email') is-invalid @enderror"
                                                id="buyers-address"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți adresa dvs. de e-mail' : 'Enter your email' }}"
                                                name="n-email" value="{{ old('n-email') ?? Auth::user()?->email }}"
                                                required>
                                            @error('n-email')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="buyers-phone"
                                                class="form-label">{{ session()->get('lang') === 'ro' ? 'Telefon' : 'Phone' }}</label>
                                            <input type="text"
                                                class="form-control @error('n-phone') is-invalid @enderror"
                                                id="buyers-phone"
                                                placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți telefonul dvs' : 'Enter your phone' }}"
                                                name="n-phone" value="{{ old('n-phone') ?? Auth::user()?->phone }}"
                                                required>
                                            @error('n-phone')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <h4 class="pt-3">
                                            {{ session()->get('lang') === 'ro' ? 'Informații despre card' : 'Card Info' }}
                                        </h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="cc-name" class="form-label">Name on card</label>
                                                <input type="text"
                                                    class="form-control @error('cc-name') is-invalid @enderror""
                                                    id="cc-name" placeholder="Enter name" name="cc-name"
                                                    value="{{ old('cc-name') }}" required>
                                                <small class="text-muted">Full name as displayed on card</small>
                                                @error('cc-name')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cc-number" class="form-label">Credit card number</label>
                                                <input type="text"
                                                    class="form-control @error('cc-number') is-invalid @enderror"
                                                    id="cc-number" placeholder="xxxx xxxx xxxx xxxx" name="cc-number"
                                                    value="{{ old('cc-number') }}" required>
                                                @error('cc-number')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-expiration" class="form-label">Expiration</label>
                                                <input type="text"
                                                    class="form-control @error('cc-expiration') is-invalid @enderror""
                                                    id="cc-expiration" placeholder="MM/YY" name="cc-expiration"
                                                    value="{{ old('cc-expiration') }}" required>
                                                @error('cc-expiration')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-cvv" class="form-label">CVV</label>
                                                <input type="text"
                                                    class="form-control @error('cc-cvv') is-invalid @enderror""
                                                    id="cc-cvv" placeholder="xxx" name="cc-cvv"
                                                    value="{{ old('cc-cvv') }}" required>
                                                @error('cc-cvv')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>




                                    <input type="hidden" name="service_id" value="{{ request('id') }}">

                                    <div class="hstack gap-2 justify-content-end pt-4">
                                        <button type="submit" class="btn btn-hover w-md btn-primary">Pay<i
                                                class="ri-logout-box-r-line align-bottom ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end conatiner-->
    </section>


    <x-subscription />

    <x-key-features />
@endsection
@section('scripts')
    <script>
        const requiredFieldsStripe = document.querySelectorAll('#stripeForm input[required]');
        const requiredFieldsNetopia = document.querySelectorAll('#netopiaForm input[required]');

        requiredFieldsStripe.forEach(field => {
            field.addEventListener('invalid', function(event) {
                // event.preventDefault(); // Stop the browser default message
                if (!field.validity.valid) {
                    field.setCustomValidity('Te rog completează acest câmp');
                }
            });

            field.addEventListener('input', function() {
                field.setCustomValidity(''); // Clear the custom message once the user types
            });
        });
        
        requiredFieldsNetopia.forEach(field => {
            field.addEventListener('invalid', function(event) {
                // event.preventDefault(); // Stop the browser default message
                if (!field.validity.valid) {
                    field.setCustomValidity('Te rog completează acest câmp');
                }
            });

            field.addEventListener('input', function() {
                field.setCustomValidity(''); // Clear the custom message once the user types
            });
        });
    </script>
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
