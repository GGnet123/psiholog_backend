@extends('layout')

@section('title', 'Привет')

@section('content')
    <!-- Post grid -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">

            </div>
        </div>
    </div>
@endsection



@section('js_block')

    <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js"></script>
    <script src="/fcmscript.js"></script>
@endsection
