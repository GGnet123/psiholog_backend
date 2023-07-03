<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="/admin-asset/assets/css/colors.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/admin-asset/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin-asset/assets/js/plugins/loaders/blockui.min.js"></script>

    <script type="text/javascript" src="/admin-asset/assets/js/core/app.js"></script>

    <script type="text/javascript" src="/admin-asset/assets/js/plugins/ui/ripple.min.js"></script>


</head>

<body class="login-container">
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content">
                <form action="{{ $action }}" method="post">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Форма входа <small class="display-block">Введите email и пароль</small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" name="login" class="form-control" placeholder="Email" required>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-pink-400 btn-block">Войти <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>
@include('vendor.sweetalert.alert')
</body>
</html>
