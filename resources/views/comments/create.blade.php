<div class="comments" style="border-bottom: 3px solid #9f9d9d4a; margin-bottom: 33px">
    <form method="post" action="{{route('comments.store',$twit->id)}}">

        <p style="margin: 0;margin-bottom: 15px;">
            @if(\Illuminate\Support\Facades\Auth::check())
                <img
                    src="{{asset('/storage/' .\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->picture)}}"
                    class="comment_profile_photo">
                <label
                    class="comments_name">{{\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->login}}
                    @else
                        <img src="{{asset('/storage/icons/user.png')}}"
                             class="comment_profile_photo">
                        <label class="comments_name">Неизвестный
                            @endif
                        </label>

                        @csrf
                        <input type="text" name="text" class="comments_text" placeholder="Добавить комментарий"
                               required>
                        <button type="submit" class="create_comments">ок</button>
                        @error('text')
                        <center><strong>{{$message}}</strong></center>
                @enderror
        </p>
    </form>
</div>
