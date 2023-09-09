@extends('user.layouts.app')
@section('postTitle', 'Welcome to My Blog')
@section('content')
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <div class="col-12 mb-4">
                    <article class="card article-card">
                        <a href="{{ route('user#readPost', $latestPost->post_id) }}">
                            <div class="card-image">
                                <div class="post-info">
                                    <span class="text-uppercase">{{ $latestPost->created_at->format('F j Y') }}</span>
                                    {{-- <span class="text-uppercase">3 minutes read</span> --}}
                                </div>
                                <img loading="lazy" decoding="async"
                                    src="{{ asset($latestPost->post_image !== null ? 'storage/postImage/' . $latestPost->post_image : 'defaultImage/default-image.jpg') }}"
                                    alt="Post Thumbnail" class="w-100">
                            </div>
                        </a>
                        <div class="card-body px-0 pb-1">
                            <ul class="post-meta mb-2">
                                <li>
                                    <a
                                        href="{{ route('user#categoryPosts', $latestPost->category_id) }}">{{ $latestPost->category_name }}</a>
                                </li>
                            </ul>
                            <h2 class="h1"><a class="post-title"
                                    href="{{ route('user#readPost', $latestPost->post_id) }}">{{ $latestPost->title }}</a>
                            </h2>
                            <p class="card-text">{!! Str::limit($latestPost->content, 100) !!}</p>
                            <div class="content"> <a class="read-more-btn"
                                    href="{{ route('user#readPost', $latestPost->post_id) }}">Read Full
                                    Article</a>
                            </div>
                        </div>
                    </article>
                </div>
                @forelse ($posts as $post)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{ route('user#readPost', $post->post_id) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ $post->created_at->format('F j Y') }}</span>
                                        {{-- <span class="text-uppercase">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                </path>
                                            </svg>
                                            count
                                        </span> --}}
                                    </div>
                                    <img loading="lazy" decoding="async"
                                        src="{{ asset($post->post_image !== null ? 'storage/postImage/' . $post->post_image : 'defaultImage/default-image.jpg') }}"
                                        alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li>
                                        <a
                                            href="{{ route('user#categoryPosts', $post->category_id) }}">{{ $post->category_name }}</a>
                                    </li>
                                </ul>
                                <h2><a class="post-title"
                                        href="{{ route('user#readPost', $post->post_id) }}">{{ $post->title }}</a></h2>
                                <p class="card-text">{!! Str::limit($post->content, 100) !!}</p>
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('user#readPost', $post->post_id) }}">Read Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-6 offset-3 position-relative" style="height: 400px">
                        <h1 class="text-muted text-center position-absolute top-50">There is no post Here!</h1>
                    </div>
                @endforelse
                <div class="col-12">
                    <nav class="mt-4">
                        <!-- pagination -->
                        <nav class="mb-md-50">
                            {{ $posts->appends(request()->query())->links() }}
                        </nav>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget-blocks">
                <div class="row">
                    @include('user.layouts.inc.aboutMe')
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Recommended</h2>
                            <div class="widget-body">
                                <div class="widget-list">
                                    {{-- <article class="card mb-4">
                                        <div class="card-image">
                                            <div class="post-info"> <span class="text-uppercase">1 minutes
                                                    read</span>
                                            </div>
                                            <img loading="lazy" decoding="async"
                                                src="images/post/post-9.jpg" alt="Post Thumbnail"
                                                class="w-100">
                                        </div>
                                        <div class="card-body px-0 pb-1">
                                            <h3><a class="post-title post-title-sm"
                                                    href="article.html">Portugal and France Now
                                                    Allow Unvaccinated Tourists</a></h3>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit, sed do eiusmod tempor …</p>
                                            <div class="content"> <a class="read-more-btn"
                                                    href="article.html">Read Full Article</a>
                                            </div>
                                        </div>
                                    </article> --}}
                                    @forelse ($recommendedPosts as $rc)
                                        <a class="media align-items-center"
                                            href="{{ route('user#readPost', $rc->post_id) }}">
                                            <img loading="lazy" decoding="async"
                                                src="{{ asset($rc->post_image !== null ? 'storage/postImage/' . $rc->post_image : 'defaultImage/default-image.jpg') }}"
                                                alt="Post Thumbnail" class="w-100">
                                            <div class="media-body ml-3">
                                                <h3 style="margin-top:-5px">{{ $rc->title }}
                                                </h3>
                                                <p class="mb-0 small text-muted">{!! Str::limit($rc->content, 50) !!}</p>
                                            </div>
                                        </a>
                                    @empty
                                        <h3 class="text-muted">There is no post Here!</h3>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Categories</h2>
                            <div class="widget-body">
                                <ul class="widget-list">
                                    @include('user.layouts.inc.category_lists')
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
