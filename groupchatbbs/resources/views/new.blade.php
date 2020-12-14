@extends('layout')

@section('content')
    <h1>グループ作成</h1>
    {{ Form::open(['route' => 'group.store']) }}
        <div class='form-group'>
            {{ Form::label('groupname', 'グループ名:') }}
            {{ Form::text('groupname', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', '　カテゴリ:') }}
            {{ Form::select('category_id', $categories) }}
        </div>
        <div class='form-group'>
            {{ Form::label('Heading' ,'　コメント:') }}
            {{ Form::text('Heading' , null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('a_time' ,'　活動時間:') }}
            {{ Form::text('a_time' , null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('a_content' ,'　　　内容:') }}
            {{ Form::text('a_content' , null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('requirement' ,'　　　条件:') }}
            {{ Form::text('requirement' , null) }}
        </div>
        <div class='form-group'>
            {{ Form::submit('作成する',['class' => 'btn btn-primary']) }}
            <a href={{ route('group.list') }}>一覧に戻る</a>
        </div>
     {{ Form::close() }}   
@endsection