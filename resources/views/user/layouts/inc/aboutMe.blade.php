<div class="col-lg-12">
    <div class="widget">
        <div class="widget-body">
            <img loading="lazy" decoding="async"
                src="{{ asset($admin->profile_picture !== null ? 'storage/authorImage/' . $admin->profile_picture : 'defaultImage/default.jpg') }}"
                alt="About Me" class="w-100 author-thumb-sm d-block">
            <h2 class="widget-title my-3">{{ $admin->name }}</h2>
            <p class="mb-3 pb-2">{{ Str::limit($admin->bio, 50) }}</p> <a href="{{ route('user#aboutMe') }}"
                class="btn btn-sm btn-outline-primary">Know
                More</a>
        </div>
    </div>
</div>
