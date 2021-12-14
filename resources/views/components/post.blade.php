<div class="flex flex-col gap-1">
    <a href="{{ route('user.posts', ['user' => $post->user]) }}" class="font-bold self-start">
        {{ $post->user->username }}
        <span class="text-gray-400 font-medium text-sm ml-1">
            {{ $post->created_at->diffForHumans() }}
        </span>
    </a>
    <p>{{ $post->body }}</p>
    <div class="flex gap-4 items-center">
        <button onclick="like(this,{{ $post->id }})" type="button"
                class="flex gap-1 font-bold text-primary text-sm items-center">
            <i
                @auth
                @class([
                        'bi',
                        'bi-hand-thumbs-up-fill' => $post->isLikedBy(auth()->user()),
                        'bi-hand-thumbs-up' => !$post->isLikedBy(auth()->user())
                        ])
                @else
                class="bi bi-hand-thumbs-up"
                @endauth
            >
            </i>
            <span>{{ $post->likes_count }}</span>
        </button>
        <button onclick="dislike(this,{{ $post->id }})" type="button"
                class="flex gap-0.5 font-medium text-primary text-sm items-center">
            <i
                @auth
                @class([
                        'bi',
                        'bi-hand-thumbs-down-fill' => $post->isDislikedBy(auth()->user()),
                        'bi-hand-thumbs-down' => !$post->isDislikedBy(auth()->user())
                        ])
                @else
                class="bi bi-hand-thumbs-down"
                @endauth
            >
            </i>
            <span>Dislike</span>
        </button>
        @can('delete', $post)
            <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete"
                       class="link link-primary link-hover font-medium text-sm">
            </form>
        @endcan
    </div>
    @unless(request()->routeIs('posts.show'))
        <a href="{{ route('posts.show', $post) }}"
           class="text-sm self-start link hover:link-primary link-hover flex items-center">
            View Post
            <i class="bi bi-arrow-right-short text-lg leading-none"></i>
        </a>
    @endif
</div>

@once
    @push('scripts')
        <script>
            const like = (likeBtn, post_id) => {
                const likeIcon = $(likeBtn).children('i');
                const likesCountContainer = $(likeBtn).children('span');
                const likesCount = parseInt(likesCountContainer.html());
                const dislikeBtn = $(likeBtn).siblings('button');
                const dislikeIcon = dislikeBtn.children('i');
                const totalLikesContainer = $('span.total-likes');
                const totalLikes = parseInt(totalLikesContainer.html());

                likeIcon.addClass('pulsate-fwd');
                likeIcon.on('animationend', function () {
                    $(this).removeClass('pulsate-fwd');
                });

                const xhr = $.post(
                    `/posts/${post_id}/like`,
                    {
                        _token: '{{ csrf_token() }}'
                    },
                    (response) => {
                        if (response.msg === 'like removed') {
                            likesCountContainer.html(likesCount - 1);
                            totalLikesContainer.html(totalLikes - 1);
                            likeIcon.removeClass('bi-hand-thumbs-up-fill');
                            likeIcon.addClass('bi-hand-thumbs-up');
                            return;
                        }

                        likesCountContainer.html(likesCount + 1);
                        totalLikesContainer.html(totalLikes + 1);
                        dislikeIcon.removeClass('bi-hand-thumbs-down-fill');
                        dislikeIcon.addClass('bi-hand-thumbs-down');
                        likeIcon.removeClass('bi-hand-thumbs-up');
                        likeIcon.addClass('bi-hand-thumbs-up-fill');
                    }
                );

                xhr.fail(xhr => {
                    if (xhr.status === 401) {
                        window.location.href = '{{ route('login.create') }}';
                    }
                });
            }

            const dislike = (dislikeBtn, post_id) => {
                const dislikeIcon = $(dislikeBtn).children('i');
                const likeBtn = $(dislikeBtn).siblings('button');
                const likeIcon = likeBtn.children('i');
                const likesCountContainer = likeBtn.children('span');
                const likesCount = parseInt(likesCountContainer.html());
                const totalLikesContainer = $('span.total-likes');
                const totalLikes = parseInt(totalLikesContainer.html());

                dislikeIcon.addClass('pulsate-fwd');
                dislikeIcon.on('animationend', function () {
                    $(this).removeClass('pulsate-fwd');
                });

                const xhr = $.post(
                    `/posts/${post_id}/dislike`,
                    {
                        _token: '{{ csrf_token() }}'
                    },
                    response => {
                        if (response.msg === 'dislike removed') {
                            dislikeIcon.removeClass('bi-hand-thumbs-down-fill');
                            dislikeIcon.addClass('bi-hand-thumbs-down');
                            return;
                        }

                        likeIcon.removeClass('bi-hand-thumbs-up-fill');
                        likeIcon.addClass('bi-hand-thumbs-up');
                        if (response.msg === 'like to dislike') {
                            likesCountContainer.html(likesCount - 1);
                            totalLikesContainer.html(totalLikes - 1);
                        }
                        dislikeIcon.removeClass('bi-hand-thumbs-down');
                        dislikeIcon.addClass('bi-hand-thumbs-down-fill');
                    }
                );

                xhr.fail(xhr => {
                    if (xhr.status === 401) {
                        window.location.href = '{{ route('login.create') }}';
                    }
                });
            }
        </script>
    @endpush
@endonce
