@extends('layouts.app')

@section('content')
    <div class="flex justify-center sm:px-5">
        <div class="bg-white sm:rounded max-w-screen-md w-full px-5 py-8 sm:px-8 flex flex-col gap-6">
            <form action="{{ route('posts') }}" method="post" class="flex flex-col items-center gap-3.5">
                @csrf
                <textarea name="body" rows="7" placeholder="Post"
                          class="textarea text-base textarea-bordered w-full bg-gray-50"></textarea>
                <input type="submit" value="POST" class="btn sm:btn-wide btn-block btn-primary btn-sm sm:btn-md">
            </form>
            @if($posts->count())
                <div class="flex flex-col gap-6">
                    @foreach($posts as $post)
                        <div class="flex flex-col gap-1">
                            <a href="" class="font-bold self-start">
                                {{ $post->user->username }}
                                <span
                                    class="text-gray-400 font-medium text-sm ml-1">{{ $post->created_at->diffForHumans() }}</span>
                            </a>
                            <p>{{ $post->body }}</p>
                            <div class="flex gap-4">
                                <button onclick="like(this,{{ $post->id }})" type="button" class="flex gap-1 font-bold text-primary">
                                    <i @class(['bi', 'bi-hand-thumbs-up-fill' => $post->isLikedBy(auth()->user()), 'bi-hand-thumbs-up' => !$post->isLikedBy(auth()->user())])></i><span>{{ $post->likes->count() }}</span>
                                </button>
                                <button onclick="disLike()" type="button" class="flex gap-0.5 font-bold text-primary"><i
                                        class="bi bi-hand-thumbs-down"></i>Dislike</button>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const like = (btnElement, post_id) => {

            $.post(
                `/posts/${post_id}/like`,
                {
                    _token: '{{ csrf_token() }}'
                },
                response => {
                    const likesCount = parseInt($(btnElement).children('span').html());

                    if (response.msg === 'disliked') {
                        $(btnElement).children('span').html(likesCount - 1);
                        $(btnElement).children('i').removeClass('bi-hand-thumbs-up-fill');
                        $(btnElement).children('i').addClass('bi-hand-thumbs-up');
                        return;
                    }

                    $(btnElement).children('span').html(likesCount + 1);
                    $(btnElement).children('i').removeClass('bi-hand-thumbs-up');
                    $(btnElement).children('i').addClass('bi-hand-thumbs-up-fill');
                }
            );
        }
    </script>
@endpush
