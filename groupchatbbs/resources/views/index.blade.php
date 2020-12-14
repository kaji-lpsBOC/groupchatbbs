
@extends('layout')

@section('content')
        <h1>グループ一覧</h1>
        @include('search')
        <table class='table table-striped table-hover'>
        <tr>
            <th>ジャンル</th>
            <th>グループ名</th>
            <th>コメント</th>
            <th>加入条件</th>
        </tr>
        @foreach($groups as $group)
        <tr>
           <p>
            <td> {{ optional($group->category)->name }}</td>
            <td>
                    <a href={{ route('group.detail',['id' => $group->id] ) }}'>
                    {{ $group->groupname }}
                    </a>  
            </td>
            <td>{{ $group->Heading}}</td>
            <td>{{ $group->requirement}}</td>
           </p>
        </tr>
        @endforeach
        </table>
        <div>
            {{ $groups->links() }}
        </div>
@endsection