@extends('layout')

@section('content')
<h1>{{ $group->groupname}}</h1>
@if (session('flash_message_create'))
    <div class="flash_message alert alert-primary" >
        {{ session('flash_message_create') }}
    </div>
@endif
@if ($errors->any())
    <div class="flash_message alert alert-danger" >
        メッセージを入力してください
    </div>
@endif
@if(isset($chats))
    @foreach($chats as $chat)
    <p>{{$chat->user_name}} :　{{ $chat->text }}（{{ $chat->created_at }}） </p>
    @endforeach
@endif

{{ Form::open(['url' => route('group.chatstore', ['id' => $group->id]) ]) }}
    <div class='form-group'>
        {{ Form::label('text', '内容:') }}
        {{ Form::text('text', null) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('送信する',['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}
<div>
    {{ $chats->links() }}
</div>
<div class='form-group'>
    <a href={{ route('group.status') }}>参加グループ一覧に戻る</a>
</div>
@endsection