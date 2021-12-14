@extends('layouts.app')

@section('content')
    <div class="flex justify-center sm:px-5 pb-5">
        <div class="bg-white sm:rounded max-w-screen-md w-full px-5 py-8 sm:px-8 flex flex-col gap-6">
            @auth
                @error('body')
                <div class="alert alert-error justify-start gap-1 self-center px-20">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}
                </div>
                @enderror
                <form action="{{ route('posts.store') }}" method="post" class="flex flex-col items-center gap-3.5">
                    @csrf
                    <textarea oninput="$(this).removeClass('textarea-error');$('.alert').hide()" name="body" rows="7" placeholder="Post"
                              class="textarea @error('body') textarea-error @enderror text-base textarea-bordered w-full bg-gray-50"></textarea>
                    <input
                        type="submit"
                        value="POST"
                        class="btn sm:btn-wide btn-block btn-primary btn-sm sm:btn-md"
                    >
                </form>
            @endauth
            @if($posts->count())
                <div class="flex flex-col gap-6">
                    @foreach($posts as $post)
                        <x-post :post="$post"></x-post>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection


