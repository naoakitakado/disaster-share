@extends('layouts.app')

@section('content')
    <h1 class="text-center font-weight-bold font-family-Tahoma">DISASTER  INFORMATION</h1>
    <div class='form-row'>
         <div class="col-md-4 offset-md-8">
            <div class="submit-form">
                {!! Form::open(['route' => 'post_searches.index', 'method' => 'get']) !!}
                     <ul class="search_form">
                        <li><input type="text" name="search" placeholder="検索はこちらから" style="height:38px; width:230px;"></li>
                        <li>
                            <button type="submit" name="button" style="cursor:pointer; border-radius:2px; height:38px;">
                                <span style="color:black;" class="fas fa-search"></span>
                            </button>
                        </li>
                    </ul>
                 {!! Form::close() !!}     
            </div>
        </div>
    </div>
    <!--検索条件に一致した投稿を表示-->
    @include('alerts.posts', ['alerts'=>$alerts])
    <style>
    .user-img{
        border-radius:50%;
        margin-bottom:10px;
    }
    .side{
      display: flex;
      justify-content:space-between;
    }
    
    .icons li{
        display:inline-block;
    }
    .search_form{
       display: flex;
       list-style:none;
       width:100%;
       justify-content: center;
    }
    .edit li{
            display:inline-block;
        }
</style>
@endsection