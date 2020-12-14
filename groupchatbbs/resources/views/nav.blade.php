
<style>
.top-right {    
                color: white;
                position: absolute;
                right: 10px;
                top: 18px;
            }
</style>
<nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top'>
    <a class='navbar-brand' href={{ route('group.list') }}>グループチャット</a>

    <div class="top-middle">
        <a type="button" class="btn btn-primary" href={{ route('group.new') }}>グループ作成</a>
        <a type="button" class="btn btn-primary" href={{ route('group.status') }}>参加グループ一覧</a>
    </div>
    @if (Route::has('login'))
        <div class="top-right">
            @auth
                <a type="button" class="btn btn-primary" href="/logout">ログアウト</a>
                <a href="">{{ Auth::user()->name }}</a>
            @else
                <a class="btn btn-primary" href="/login">ログイン</a>
                @if (Route::has('register'))
                    <a class="btn btn-primary" href="{{ route('register') }}">登録</a>
                @endif
            @endauth
        </div>
    @endif
</nav>