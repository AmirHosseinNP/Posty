@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center sm:px-5 pb-5 gap-5">
        <div class="bg-white sm:rounded max-w-screen-md w-full px-5 py-8 sm:px-8 flex flex-col gap-6">
            <div class="flex flex-col gap-6">
                <x-post :post="$post"></x-post>
            </div>
        </div>
    </div>
@endsection


