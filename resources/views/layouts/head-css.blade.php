@yield('css')
<style>
section h1 {
  font-size: 2rem; /* Or whatever size you prefer */
}
@media (max-width: 992px) {
  #navbarSupportedContent {
    margin-top: 35px;
  }

  #navHomeBtn {
    display: inline-block !important;
  }
}

.bg-success-subtle-custom {
  /* background-color: #d1e7dd !important; */
  background-color: #cdf7ecbe !important;
  
  /* background-color: #d1e7dd !important; */
  /* color: #0f5132 !important; */
}
</style>
{{-- <link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css"> --}}
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<!-- Icons Css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" rel="stylesheet" type="text/css">
<!-- custom Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}" rel="stylesheet" type="text/css">


{{-- <link href="{{ mix('build/css/all.css') }}" rel="stylesheet" type="text/css"> --}}