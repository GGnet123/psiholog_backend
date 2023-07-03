@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">{{ $title  }}</div>
                <div class="panel-body">
                    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Логин</label>
                            <input type="text" name="login" class="form-control" value="{{ $user->login }}" required>
                        </div>
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Старый пароль</label>
                                <input type="password" name="old_pass"  class="form-control" >
                            </div>
                            <div class="col-md-6">
                                <label>Новый пароль</label>
                                <input type="password" name="new_pass"  class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
