<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="{{ route('user#home') }}">
                <img loading="prelaod" decoding="async" class="img-fluid" src="{{ asset('user/images/logo.png') }}"
                    alt="Reporter Hugo">
            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button"
                    data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <form action="{{ route('user#searchPosts') }}" class="search order-lg-3 order-md-2 order-3 ml-auto">
                @csrf
                <input id="search-query" name="key" value="{{ request('key') }}" type="search"
                    placeholder="Search..." autocomplete="off">
            </form>
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user#aboutMe') }}">About Me</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Articles
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user#home') }}">All Posts</a>
                            @foreach (\App\Models\Category::get() as $category)
                                <a class="dropdown-item"
                                    href="{{ route('user#categoryPosts', $category->category_id) }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user#contact') }}">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-demo" data-bs-theme="dark">
                            <a class="dropdown-item" href="{{ route('user#profile') }}">
                                Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" value="Logout" class="dropdown-item text-danger">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
