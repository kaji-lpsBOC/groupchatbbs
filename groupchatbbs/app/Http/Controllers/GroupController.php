<?php

namespace App\Http\Controllers;

use App\Group;
use App\Category;
use App\User;
use App\Membership;
use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;

class GroupController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $categories = Category::all()->pluck('name','id');
        if($request->filled('keyword') && $request->filled('category_id')){ 
            $keyword = $request->input('keyword');
            $category_id = $request->input('category_id');
            $message = 'カテゴリー'.$category_id.'検索結果: '.$keyword;
            $groups = Group::where('groupname','like','%' .$keyword. '%')->where('category_id', $category_id)->paginate(8);
        }
        else if($request->filled('keyword')){
            $keyword = $request->input('keyword');
            $message = '検索結果: '.$keyword;
            $groups = Group::where('groupname','like','%' .$keyword. '%')->paginate(8);
        }
        else if($request->filled('category_id')){
            $category_id = $request->input('category_id');
            $message = 'カテゴリー'.$category_id;
            $groups = Group::where('category_id', $category_id)->paginate(8);//get();
        }
        else{
            $message = 'グループ募集掲示板へようこそ！！';
            $groups = Group::paginate(8);
        }
        return view('index',['message' => $message,'groups' => $groups,'categories' => $categories]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $user = Auth::user();
        if(Auth::user()){
            $categories = Category::all()->pluck('name','id');
            return view('new',['categories' => $categories]);
        }else{
            return redirect('/login');
        }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       $group = new Group();

       $user = Auth::user();

       $rules =[
           'groupname' => 'required',
           'Heading' => 'required',
           'requirement' => 'required',
           'a_content' => 'required',
           'a_time' => 'required',
       ];
       $this->validate($request,$rules);

       $group->groupname = request('groupname');
       $group->category_id = request('category_id');
       $group->r_name = $user->name;
       $group->Heading = request('Heading');
       $group->a_time = request('a_time');
       $group->a_content = request('a_content');
       $group->requirement = request('requirement');
       //$group->max_member = $request->max_member;
       //$group->form = $request->form;
       $group->save();
       $this->join($group->id);
       return redirect()->route('group.detail', ['id' => $group->id],)->with('flash_message_create', 'グループを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        return view('show',['group' => $group]);
    }

    /** 
     * User join a group
     * 
    */
    public function join($group_id)
    {   
        $memberships = Membership::all();
        $user = Auth::user();
        if(Auth::user()){
            $membership = new Membership();
            $group = Group::find($group_id);
            $membership->group_id = $group->id;
            $membership->user_id = $user->id;
            for($i = 0; $i < $memberships->count(); $i++){    
                if($memberships[$i]->group_id == $membership->group_id && $memberships[$i]->user_id == $membership->user_id){
                    return redirect()->route('group.detail', ['id' => $group->id])->with('flash_message', 'すでにこのグループに参加しています。');
                }
            }
            $membership->save();
            return view('join',['group' => $group]);
        }else{
            return redirect('/login');
        }
    }

    public function status()
    {  
        if(Auth::user()){
            $user = Auth::user();
            $groups = User::find($user->id)->groups;
            return view('status',['groups' => $groups]);
        }else{
            return redirect('/login');
        }
    }

    public function chat($id)
    {   
        $group = Group::find($id);
        $user = Auth::user();
        $chats = Chat::where('group_id',$id)->orderBy('created_at', 'DESC')->paginate(13);

        return  view('chat',['id' => $group->id,'chats' => $chats,'user' => $user ,'group' =>$group]);
    }
    public function chatstore(Request $request,$id)
    {   
        $rules =[
            'text' => 'required'
        ];
        $this->validate($request,$rules);
        $group = Group::find($id);
        $user = Auth::user();
        $chat = new Chat();
        $chat->text = request('text');
        $chat->group_id = $group->id;
        $chat->user_id = $user->id;
        $chat->user_name = $user->name;
        $chat->save();
        $chats =Chat::find($id);
        return  redirect()->route('group.chat',['id' => $group->id,'chat' => $chat ,'chats' => $chats])->with('flash_message_create', 'メッセ―ジを投稿しました');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id, Group $group)
    {
        $message = 'Edit your article '.$id;
        $article = Group::find($id);
        return view('edit',['message' => $message, 'group' =>$group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Article $article)
    {
        $article = Article::find($id);

       $article->content = $request->content;
       $article->user_name = $request->user_name;
       $article->save();
       return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id, Article $article)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles');
    }
}
/*
@if (session('flash_message_create'))
    <div class="flash_message alert alert-primary" >
        {{ session('flash_message_create') }}
    </div>
@endif
@if(isset($chat))
    {{ $chat->text }}
@endif

{{ Form::open(['route' => 'group.chatstore']) }}
    <h1>{{ $group->groupname}}</h1>
    <p>{{ $user->name }}</p>
    <div class='form-group'>
        {{ Form::label('text', '内容:') }}
        {{ Form::text('text', null) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('送信する',['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}
*/