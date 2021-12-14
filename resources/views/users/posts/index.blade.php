@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center sm:px-5 pb-5 gap-5">
        <div class="max-w-screen-md w-full mt-7 flex flex-col gap-2">
            <h1 class="text-2xl font-semibold capitalize">{{ $user->name }}</h1>
            <p>
                Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and
                received <span class="total-likes">{{ $user->received_likes }}</span> {{ Str::plural('like', $user->received_likes) }}
            </p>
        </div>
        <div class="bg-white sm:rounded max-w-screen-md w-full px-5 py-8 sm:px-8 flex flex-col gap-6">
            @if($posts->count())
                <div class="flex flex-col gap-6">
                    @foreach($posts as $post)
                        <x-post :post="$post"></x-post>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            @else
                <p>{{ $user->username }} does not have any posts.</p>
            @endif
        </div>
    </div>
@endsection


