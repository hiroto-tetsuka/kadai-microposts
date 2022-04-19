@if (count($microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div>
                        {{-- 自分の投稿には削除ボタンを表示 --}}
                        @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                            @if(Auth::user()->is_favorite($micropost->id))
                                {{-- お気に入り解除ボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
                                    <input type='hidden' name='micropost_id' value="{{$micropost->id}}">
                                {!! Form::close() !!}
                            @else
                                {{-- お気に入りボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.favorite', $micropost->id], 'method' => 'post']) !!}
                                    {!! Form::submit('Favorite', ['class' => 'btn btn-danger btn-sm']) !!}
                                    <input type='hidden' name='micropost_id' value="{{$micropost->id}}">
                                {!! Form::close() !!}
                            @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif