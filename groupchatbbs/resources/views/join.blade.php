@extends('layout')


@section('content')
    <h1>{{ $group->groupname}}に参加しました。</h1>
        <br>
        <div>
            <a href="{{ route('group.list') }}">グループ一覧に戻る</a>
        </div>
@endsection