{{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('category_id', 'カテゴリー') }}
        {{ Form::select('category_id',$categories,null,['class' => 'form-control' , 'placeholder' => 'カテゴリー']) }}
    </div>
    <div classs='form-group'>
        {{ Form::label('keyword' , 'グループ名') }}
        {{ Form::text('keyword' ,null,['class' => 'form-control']) }}
    </div> 
    <div class='form-group'>
        {{ Form::submit('検索' , ['class' =>'btn btn-outline-primary']) }}
        <a href={{ route('group.list')}}>クリア</a>
    </div>    
{{ form::close() }}