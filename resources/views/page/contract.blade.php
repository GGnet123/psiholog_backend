@extends('layout')

@section('title', $title)

@section('content')
    <h2>{{$title}}</h2>
    <div class="col-md-8">
        <div style="display: flex; align-items: center">
            <input type="file" accept="application/pdf,.pdf" id="upload-contract-input">
            <button class="btn btn-success ml-5" id="upload-contract-btn">Загрузить</button>
        </div>
    </div>
    @if($hasContract)
        <div class="col-md-8 mt-10">
            <a href="/{{$filePath}}" download class="btn btn-warning">Скачать загруженный договор</a>
        </div>
    @endif

    <script>
        $(function () {
            $('#upload-contract-btn').click(function () {
                let fd = new FormData()
                var files = $('#upload-contract-input')[0].files;
                if (files.length > 0) {
                    fd.append('file',files[0]);
                    $.ajax({
                        url:'/admin/contract/upload',
                        type:'post',
                        data:fd,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success:function(response){
                            window.location = location.href
                        }
                    });
                }
            })
        })
    </script>
@endsection
