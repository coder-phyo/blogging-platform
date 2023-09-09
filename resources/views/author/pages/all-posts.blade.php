@extends('author.layouts.app')
@section('title', 'All Posts')
@section('contents')
    <div class="row g-2 align-items-center mt-5 mb-5">
        <div class="col-7 col-sm-8">
            <h2 class="page-title text-white">
                All Posts
            </h2>
        </div>
        <div class="col-5 col-sm-4 col-lg-3 offset-lg-1">
            <form action="{{ route('author#allPosts') }}" method="get">
                @csrf
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </span>
                    <input type="search" name="key" value="{{ request('key') }}" class="form-control"
                        placeholder="Search posts…" aria-label="Search in website">
                </div>
            </form>
        </div>
        @if (Session::has('updateSuccess'))
            <div class="alert alert-warning alert-tr fade show col-auto position-absolute end-0 opacity-90" role="alert">
                <strong>{{ Session::get('updateSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-tr fade show col-auto position-absolute end-0 opacity-90" role="alert">
                <strong>{{ Session::get('deleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    <div class="row row-cards">
        @forelse ($posts as $post)
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <img src="{{ asset($post->post_image != null ? 'storage/postImage/' . $post->post_image : 'defaultImage/default-image.jpg') }}"
                        class="card-img-top" style="height: 240px;">
                    <div class="card-body">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('author#editPage', $post->post_id) }}" class="card-btn text-primary">Edit</a>
                        <a href="{{ route('author#deletePost', $post->post_id) }}" class="card-btn text-danger">Delete</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-6 offset-3 position-relative" style="height: 400px">
                <h1 class="text-muted text-center position-absolute top-50">There is no post Here!</h1>
            </div>
        @endforelse
        {{ $posts->appends(request()->query())->links() }}
    </div>
@endsection
