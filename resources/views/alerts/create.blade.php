@extends('layouts.app')

@section('content')
    <h1 class="text-center font-weight-bold font-family-Tahoma">NEW POST</h1>
    {!! Form::model($alert, ['route' => 'alerts.store', 'files' => true, 'onsubmit' => "return false;"]) !!}
        <div class='form-row'>
            <div class="col-md-3">
                {!! Form::label('thefile', '画像') !!}
                    <label>
                        <span class="fa fa-file-image inline-block" style="cursor: pointer; font-size:85px; margin-bottom:30px;"></span>
                        <input type="file" style="display:none" name="thefile">
                    </label>
                    <span id="fileimg" class="inline-block"></span>
            </div>
            <div class='col-md-9'>
                <p style="text-align:right;">※位置情報は検索するか地図をタッチしてください。</p>
                @include('commons.error_messages')
            </div>
        </div>
        <div class='form-row'>
            <div class='col-md-7'>
                {!! Form::label('title', 'タイトル(15字以内):') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                {!! Form::label('content', 'メッセージ(140字以内):') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>
            <div class='col-md-5'>
                {!! Form::label('area', 'エリア') !!}
                @include('commons.area')
                {!! Form::label('location', '場所') !!}
                {!! Form::text('location', null, ['class' => 'form-control']) !!}
                <div class="box">
                    <div class="search">
                        <input id="place" placeholder="場所の検索はこちら">
                        <div id="myBtn" onclick="search()"></div>
                    </div>
                    <div id="map"></div>
                </div>
                <input type="hidden" name='lat' id='lat' class="form-control">
                <input type="hidden" name='lng' id='lng' class="form-control">
            </div>
        </div>
        <p class="submit">{!! Form::button('投稿', ['class' => 'btn btn-primary', 'onclick' => 'submit();']) !!}</p>
    {!! Form::close() !!}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoKnN8__KItXFDswfAfs_y3VHwfbX3_ms"></script>
    <script src="{{ asset('/js/file_upload.js') }}"></script>
    <script src="{{ asset('/js/alert_create.js') }}"></script>
    <style>
        #error {
            color: red;
        }
        
        .file_upload {
            border: 3px solid;
            display: inline-block;
            padding: 2px 1em;
            position: relative;
           
        }
        .form-group {
            display:inline-block;
        }
        .submit{
            position: absolute;
            top:660;
        }
        #map { 
            height: 250px
        }
        .search{
            padding-top:20px;
        }
        .inline-block{
            display: inline-block;
            vertical-align: top;
        }
        .box {
            padding-top:10px;
            position: relative;
        }
        .search{
            position: absolute;
            top:0;
            left: 200;
            z-index: 1;
        }
    </style>
@endsection
