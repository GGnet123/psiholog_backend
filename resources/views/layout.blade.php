<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="/vendor/footable.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/custom.css" rel="stylesheet" type="text/css">
    @section('css_block')
    @show

    <script type="text/javascript" src="/admin-asset/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="/admin-asset/custom/jquery.mask.min.js?15"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/forms/selects/select2.min.js"></script>


    <script type="text/javascript" src="/admin-asset/assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="/admin-asset/assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/notifications/pnotify.min.js"></script>

    <script type="text/javascript" src="/admin-asset/assets/js/core/app.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="/vendor/footable.min.js"></script>
    <script type="text/javascript" src="/admin-asset/custom/js/main.js"></script>

    <script type="text/javascript" src="/admin-asset/assets/js/plugins/editors/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/pages/editor_summernote.js"></script>


    @section('js_block')
    @show
</head>
<body>
@include('__block.main_navbar')
<div class="page-container">
    <div class="page-content">
        @include('__block.sidebar')

        <div class="content-wrapper">
            @include('__block.page_header')

            <div class="content">

                @yield('content')

                @include('__block.footer')
            </div>
        </div>
    </div>
</div>

@include('vendor.sweetalert.alert')
</body>
</html>
