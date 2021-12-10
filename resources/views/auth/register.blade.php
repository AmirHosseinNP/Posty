@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="card max-w-[500px] w-full bg-white rounded-lg shadow-md">
            <div class="card-body p-5">
                <form action="{{ route('register') }}" method="post" class="flex flex-col">
                    @csrf
                    <x-input label="Your name:" type="text" name="name" placeholder="Name"></x-input>
                    <x-input label="Username:" type="text" name="username" placeholder="Username"></x-input>
                    <x-input label="Your email:" type="text" name="email" placeholder="Email"></x-input>
                    <x-input label="Password:" type="password" name="password" placeholder="Choose a password"></x-input>
                    <x-input label="Password again:" type="password" name="password_confirmation" placeholder="Repeat your password"></x-input>
                    <input value="Register" type="submit" class="btn btn-primary btn-block mt-5">
                </form>
            </div>
        </div>
    </div>
@endsection
