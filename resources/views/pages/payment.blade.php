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
                                <span class="d-none d-sm-block"> <i class="ri-bank-card-fill align-bottom pe-2"></i>
                                    Stripe</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link py-3" data-bs-toggle="tab" href="#netopia" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-wallet-fill align-bottom"></i></span>
                                <span class="d-none d-sm-block"><i
                                        class="ri-wallet-fill align-bottom pe-2"></i>Netopia</span>
                            </a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">

                        <div class="tab-pane active" id="credit" role="tabpanel">
                            <div class="card">
                                <form class="card-body" action="/checkout/stripe" method="post">
                                    @csrf
                                    
                                    <h4>{{ session()->get('lang') === 'ro' ? 'Informații despre persoană' : 'Person Info' }}</h4>
                                    <hr>
                                        <div class="row gy-3">
                                            <div class="col-md-6">
                                                <label for="name"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Nume' : 'Name' }}</label>
                                                <input type="text" class="form-control @error('s-name') is-invalid @enderror"
                                                    id="name"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele dvs' : 'Enter your name' }}"
                                                    name="s-name" value="{{ old('s-name') ?? Auth::user()?->name }}">
                                                @error('s-name')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="address"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Adresa' : 'Address' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-address') is-invalid @enderror" id="address"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introdu adresa ta' : 'Enter your address' }}"
                                                    name="s-address" value="{{ old('s-address') }}">
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
                                                    class="form-control @error('s-city') is-invalid @enderror"
                                                    id="city"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți orașul dvs.' : 'Enter your city' }}"
                                                    name="s-city" value="{{ old('s-city') ?? Auth::user()?->city }}">
                                                @error('s-city')
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
                                                    name="s-country" value="{{ old('s-country') ?? Auth::user()?->country }}">
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
                                                    name="s-email" value="{{ old('s-email') ?? Auth::user()?->email }}">
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
                                                    name="s-phone" value="{{ old('s-phone') ?? Auth::user()?->phone }}">
                                                @error('s-phone')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <h4 class="pt-3">{{ session()->get('lang') === 'ro' ? 'Informații despre firmă/companie' : 'Firm/Company Info' }}</h4>
                                        <hr>
                                        <div class="row gy-3">
                                            <div class="col-md-12">
                                                <label for="company"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numele companiei' : 'Company Name' }}</label>
                                                <input type="text" class="form-control @error('s-company') is-invalid @enderror"
                                                    id="company"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele companiei dvs.' : 'Enter your company name' }}"
                                                    name="s-company" value="{{ old('s-company') }}">
                                                @error('s-company')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="vat"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Cod TVA' : 'VAT Number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('s-vat') is-invalid @enderror" id="vat"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți codul TVA al companiei' : 'Enter company vat number' }}"
                                                    name="s-vat" value="{{ old('s-vat') }}">
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
                                                    name="s-trade" value="{{ old('s-trade') }}">
                                                @error('s-trade')
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
                                <form class="card-body" action="/checkout/netopia" method="post">
                                    @csrf
                                    @auth
                                        {{-- <p class="form-label"><i class="ri-information-line align-bottom ms-2"></i>
                                            {{ session()->get('lang') === 'ro' ? 'Finalizați plata pentru a vă confirma comanda' : 'Complete payment to confirm your order' }}
                                        </p> --}}
                                    @endauth
                                    <h4>{{ session()->get('lang') === 'ro' ? 'Informații despre persoană' : 'Person Info' }}</h4>
                                    <hr>
                                    <div class="row gy-3">
                                        
                                            <div class="col-md-6">
                                                <label for="name"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Nume' : 'Name' }}</label>
                                                <input type="text"
                                                    class="form-control @error('n-name') is-invalid @enderror" id="name"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele dvs' : 'Enter your name' }}"
                                                    name="n-name" value="{{ old('n-name') ?? Auth::user()?->name }}">
                                                @error('n-name')
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
                                                    name="n-address" value="{{ old('n-address') }}">
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
                                                    class="form-control @error('n-city') is-invalid @enderror"
                                                    id="city"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți orașul dvs.' : 'Enter your city' }}"
                                                    name="n-city" value="{{ old('n-city') ?? Auth::user()?->city }}">
                                                @error('n-city')
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
                                                    name="n-country" value="{{ old('n-country') ?? Auth::user()?->country }}">
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
                                                    name="n-email" value="{{ old('n-email') ?? Auth::user()?->email }}">
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
                                                    name="n-phone" value="{{ old('n-phone') ?? Auth::user()?->phone }}">
                                                @error('n-phone')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <h4 class="pt-3">{{ session()->get('lang') === 'ro' ? 'Informații despre firmă/companie' : 'Firm/Company Info' }}</h4>
                                        <hr>
                                        <div class="row gy-3">
                                            <div class="col-md-12">
                                                <label for="company"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numele companiei' : 'Company Name' }}</label>
                                                <input type="text" class="form-control @error('n-company') is-invalid @enderror"
                                                    id="company"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numele companiei dvs.' : 'Enter your company name' }}"
                                                    name="n-company" value="{{ old('n-company') }}">
                                                @error('n-company')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="vat"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Cod TVA' : 'VAT Number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('n-vat') is-invalid @enderror" id="vat"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți codul TVA al companiei' : 'Enter company vat number' }}"
                                                    name="n-vat" value="{{ old('n-vat') }}">
                                                @error('n-vat')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="trade"
                                                    class="form-label">{{ session()->get('lang') === 'ro' ? 'Numărul de înregistrare la Registrul Comerțului' : 'Trade Register registration number' }}</label>
                                                <input type="text"
                                                    class="form-control @error('n-trade') is-invalid @enderror"
                                                    id="trade"
                                                    placeholder="{{ session()->get('lang') === 'ro' ? 'Introduceți numărul de înregistrare la registrul comerțului' : 'Enter trade register registration number' }}"
                                                    name="n-trade" value="{{ old('n-trade') }}">
                                                @error('n-trade')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <h4 class="pt-3">{{ session()->get('lang') === 'ro' ? 'Informații despre card' : 'Card Info' }}</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="cc-name" class="form-label">Name on card</label>
                                                <input type="text"
                                                    class="form-control @error('cc-name') is-invalid @enderror""
                                                    id="cc-name" placeholder="Enter name" name="cc-name"
                                                    value="{{ old('cc-name') }}">
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
                                                    value="{{ old('cc-number') }}">
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
                                                    value="{{ old('cc-expiration') }}">
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
                                                    value="{{ old('cc-cvv') }}">
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
    <!-- landing-index js -->
    <script src="{{ URL::asset('build/js/frontend/menu.init.js') }}"></script>
@endsection
