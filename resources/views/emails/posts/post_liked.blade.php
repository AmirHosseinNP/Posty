@component('mail::message')

<a href="{{ route('user.posts', $liker) }}">{{ $liker->username }}</a>
liked one of your posts.

@component('mail::button', ['url' => route('posts.show', $post)])
View post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
