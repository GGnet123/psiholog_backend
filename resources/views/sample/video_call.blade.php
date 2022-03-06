<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Video Call -- Agora</title>
    <link rel="stylesheet" href="/sample/video_call/assets/bootstrap.min.css">
    <link rel="stylesheet" href="/sample/video_call/assets/index.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <form id="join-form">
            <div class="button-group">
                <a href="{{ route('admin_index')  }}" class="btn btn-primary btn-sm">Назад в Админку</a>
                <button id="joinAsDoctor" type="button" class="btn btn-primary btn-sm">Join As Doctor</button>
                <button id="joinAsUser" type="button" class="btn btn-primary btn-sm">Join As User</button>
                <button id="leave" type="button" class="btn btn-primary btn-sm">Leave</button>
            </div>
        </form>
        <div class="row video-group">
            <div class="col">
                <p id="local-player-name" class="player-name"></p>
                <div id="local-player" class="player"></div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div id="remote-playerlist"></div>
            </div>
        </div>
    </div>

    <script src="/sample/video_call/assets/jquery-3.4.1.min.js"></script>
    <script src="/sample/video_call/assets/bootstrap.bundle.min.js"></script>
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script src="/sample/video_call/assets/basicVideoCall.js"></script>
</body>
</html>
