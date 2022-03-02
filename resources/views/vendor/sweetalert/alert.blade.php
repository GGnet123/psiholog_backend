@if (config('sweetalert.alwaysLoadJS') === true && config('sweetalert.neverLoadJS') === false )
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
@endif

@if(config('sweetalert.animation.enable'))
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
@endif
@if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
@endif


@if (Session::has('error'))
    {!! Session::get('error') !!}
    <script>
        Swal.fire({
            text: "{!! Session::get('error') !!}",
            icon: "error",
            showCancelButton: false,
        });
    </script>
@endif

@if (Session::has('success'))
    <script>
        Swal.fire({
            text: "{!! Session::get('success') !!}",
            icon: "success",
            showCancelButton: false,
        });
    </script>
@endif

@if (Session::has('info'))
    <script>
        Swal.fire({
            text: "{!! Session::get('info') !!}",
            icon: "info",
            showCancelButton: false,
        });
    </script>
@endif

@if (Session::has('warning'))
    <script>
        Swal.fire({
            text: "{!! Session::get('warning') !!}",
            icon: "warning",
            showCancelButton: false,
        });
    </script>
@endif
