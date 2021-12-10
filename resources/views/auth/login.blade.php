@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="card static max-w-[500px] w-full bg-white rounded-lg shadow-md">
            <div class="card-body p-5">
                @error('msg')
                <div class="alert alert-error mb-2 rounded-lg p-0 h-12">
                    <label class="items-center gap-1 flex-1 justify-center">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        Wrong email or password
                    </label>
                </div>
                @enderror
                <form action="{{ route('login') }}" method="post" class="flex flex-col">
                    @csrf
                    <x-input label="Your email:" type="text" name="email" placeholder="Enter your email"></x-input>
                    <x-input label="Password:" type="password" name="password"
                             placeholder="Enter your password"></x-input>
                    <div class="form-control mt-3">
                        <label class="label items-start gap-1.5 justify-start">
                            <input type="checkbox" name="remember" class="checkbox" value="true">
                            Remember me
                        </label>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block mt-5" value="Login">
                </form>
            </div>
        </div>
    </div>
@endsection
