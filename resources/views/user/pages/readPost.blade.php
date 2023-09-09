@extends('user.layouts.app')
@section('postTitle', 'read-post')
@section('content')
    <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
            <article>
                <img loading="lazy" decoding="async"
                    src="{{ asset($post->post_image !== null ? 'storage/postImage/' . $post->post_image : 'defaultImage/default-image.jpg') }}"
                    alt="Post Thumbnail" class="w-100">
                <ul class="post-meta mb-2 mt-4">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                            <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z">
                            </path>
                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z">
                            </path>
                        </svg> <span>{{ $post->created_at->format('j F, Y') }}</span>
                    </li>
                </ul>
                <h1 class="my-3">{{ $post->title }}</h1>
                <ul class="post-meta mb-4">
                    <li>
                        <a href="{{ route('user#categoryPosts', $post->category_id) }}">{{ $post->category_name }}</a>
                    </li>
                </ul>
                <div class="content text-left">
                    {!! $post->content !!}
                </div>
            </article>

            <div class="col-lg-12 col-md-6 mt-5">
                <div class="widget">
                    <h2 class="section-title mb-3">Related Posts</h2>
                    <div class="widget-body">
                        <div class="widget-list">
                            @forelse ($relatedPosts as $rp)
                                <a class="media align-items-center" href="{{ route('user#readPost', $rp->post_id) }}">
                                    <img loading="lazy" decoding="async"
                                        src="{{ asset($rp->post_image !== null ? 'storage/postImage/' . $rp->post_image : 'defaultImage/default-image.jpg') }}"
                                        alt="Post Thumbnail" class="w-100">
                                    <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{ $rp->title }}</h3>
                                        <p class="mb-0 small">{!! Str::limit($rp->content, 50) !!}</p>
                                    </div>
                                </a>
                            @empty
                                <h3 class="text-muted">There is no post Here!</h3>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

                        var disqus_config = function() {
                            this.page.url =
                                "{{ route('user#readPost', $post->post_id) }}"; // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier =
                                "{{ $post->post_id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://reporter-1.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                            powered by Disqus.</a></noscript>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="widget-blocks">
                <div class="row">
                    @include('user.layouts.inc.aboutMe')
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Latest Posts</h2>
                            <div class="widget-body">
                                <div class="widget-list">
                                    @forelse ($latestPosts as $lp)
                                        <a class="media align-items-center"
                                            href="{{ route('user#readPost', $lp->post_id) }}">
                                            <img loading="lazy" decoding="async"
                                                src="{{ asset($lp->post_image !== null ? 'storage/postImage/' . $lp->post_image : 'defaultImage/default-image.jpg') }}"
                                                alt="Post Thumbnail" class="w-100">
                                            <div class="media-body ml-3">
                                                <h3 style="margin-top:-5px">{{ $lp->title }}</h3>
                                                <p class="mb-0 small">{!! Str::limit($lp->content, 50) !!}</p>
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
@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('share_buttons(plugin)/jquery.floating-social-share.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('share_buttons(plugin)/jquery.floating-social-share.min.js') }}"></script>
    <script>
        $("body").floatingSocialShare({
            buttons: ["facebook", "twitter", "odnoklassniki", "tumblr", "viber", "vk", "whatsapp", "reddit",
                "telegram", "linkedin", "pinterest", "mail"
            ],
            text: "share with: ",
            url: "{{ route('user#readPost', $post->post_id) }}"
        })
    </script>
@endpush
