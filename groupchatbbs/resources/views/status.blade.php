@extends('layout')


@section('content')
    <div class="m-3">
        <a href="{{ route('group.list') }}">グループ検索へ</a>
    </div>
    @foreach($groups as $group)     
    <div class="card m-2">
        <div class="card-body">
            <h4 class="card-title">{{ $group->groupname }}</h4>
            <p class="card-text">
                活動時間:{{$group->a_time}}
            </p>
            <p class="card-text">
                {{$group->a_content}}
            </p>
            <a href={{ route('group.chat',['id' => $group->id] )}} class="btn btn-primary">Go Chat</a>
        </div>
    </div>
    @endforeach
@endsection