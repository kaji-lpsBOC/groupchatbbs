@extends('layout')


@section('content')
    <h1>{{ $group->groupname}}</h1>
    @if (session('flash_message'))
            <div class="flash_message alert alert-danger" >
                {{ session('flash_message') }}
            </div>
    @endif
    @if (session('flash_message_create'))
            <div class="flash_message alert alert-primary" >
                {{ session('flash_message_create') }}
            </div>
    @endif
    <div>
        <p>ジャンル:   {{ $group->category->name}}</p>   
        <p>作成者:   {{ $group->r_name}}</p>   
        <p>一言:   {{ $group->Heading}}</p>   
        <p>時間:   {{ $group->a_time}}</p>   
        <p>内容:   {{ $group->a_content}}</p>   
        <p>条件:   {{ $group->requirement}}</p>   
    </div>
    <div>
        <a href="{{ route('group.join',['group_id' => $group->id]) }}" class="btn btn-primary">参加する</a>
    </div>
    <br>
    <div>
        <a href="{{ route('group.list') }}">グループ一覧に戻る</a>
    </div>
        
@endsection