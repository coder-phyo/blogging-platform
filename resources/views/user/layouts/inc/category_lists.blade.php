@forelse ($categories as $category)
    <li><a href="{{ route('user#categoryPosts', $category->category_id) }}">{{ $category->category_name }}<span
                class="ml-auto"></span></a>
    </li>
@empty
    <li>
        <h3 class="text-muted">There is no post Here!</h3>
    </li>
@endforelse
