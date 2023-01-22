@extends('layouts.header')

@section('content')
    <div class="users">
        <div class="twits welcome_twits">
            @if($twit->retwit!=1)
            <div class="twit">
                <div class="twit_info">
                    <a href="{{route('users.show',$twit->user_id)}}"> <img
                            src="{{asset('/storage/' .\App\Models\User::find($twit->user_id)->picture)}}"
                            class="twit_profile_photo" alt="missing image">
                        <label class="twit_header" style="cursor: pointer; display: inline"><label class="twit_name"
                                                                                                   style="cursor: pointer">
                                {{\App\Models\User::find($twit->user_id)->login}} </label>
                    @include('layouts.twit')

                </div>
            </div>
            @else
                @include('layouts.retwit')
            @endif
            @foreach($comments as $comment)
                @if($comment->is_answer!=1)
                    @include('comments.show')
                @endif
            @endforeach
            @include('comments.create')

        </div>
        <p>{{$comments->withQueryString()->links()}}</p>
    </div>
@endsection
