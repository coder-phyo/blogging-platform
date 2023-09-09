@extends('user.layouts.app')
@section('postTitle', 'Welcome to My Blog')
@section('content')
    <div class="row">
        <div class="col-lg-8 ">
            <div class="breadcrumbs mb-4"> <a href="{{ route('user#home') }}">Home</a>
                <span class="mx-1">/</span> <a href="{{ route('user#aboutMe') }}">About</a>
            </div>
        </div>
        <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
            <img loading="lazy" decoding="async"
                src="{{ asset($admin->profile_picture !== null ? 'storage/authorImage/' . $admin->profile_picture : 'defaultImage/default.jpg') }}"
                class="img-fluid w-100 mb-4" alt="Author Image">
            <h1 class="mb-4">{{ $admin->name }}</h1>
            <div class="content">
                {{ $admin->bio }}
            </div>
        </div>
    </div>
@endsection
