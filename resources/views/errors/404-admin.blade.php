@extends('layouts.admin.master')
@section('title')
    404
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <div class="w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-card mx-lg-3">
                        <div class="card border-0 mb-0">
                            <div class="card-body text-center p-4">

                                <div class="text-center px-sm-5 mx-5">
                                    <img src="{{ URL::asset('build/images/error400.png') }}" class="img-fluid" alt="">
                                </div>
                                <div class="mt-4 text-center pt-3">
                                    <div class="position-relative">
                                        <h4 class="fs-18 error-subtitle text-uppercase mb-0">Opps, page not found!</h4>
                                        <p class="fs-15 text-muted mt-3">The page you're looking for doesn't exist or has been moved.</p>
                                        <div class="mt-4">
                                            <a href="/admin/dashboard" class="btn btn-primary"><i
                                                    class="mdi mdi-home me-1"></i>Back to Dashboard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

    </div>
@endsection
