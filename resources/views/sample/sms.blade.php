<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sms</title>
    <link rel="stylesheet" href="/sample/video_call/assets/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <form action="{{ route('sample_sms_save') }}" method="post" >
        <div class="button-group">
            <a href="{{ route('admin_index')  }}" class="btn btn-primary btn-sm">Назад в Админку</a>

        </div>
        <br/>

        <button type="submit" class="btn btn-primary btn-block">Отправить смс (+77024982488)</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>

<script src="/sample/video_call/assets/jquery-3.4.1.min.js"></script>
<script src="/sample/video_call/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
