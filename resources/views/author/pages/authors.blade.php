@extends('author.layouts.app')
@section('title', 'authors')
@section('contents')
    <div class="page-wrapper">
        <div class="modal modal-blur fade" id="add-author" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Author</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @livewire('author.add-authors')
                </div>
            </div>
        </div>

        {{-- <div class="modal modal-blur fade" id="edit-author-modal" tabindex="-1" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Author</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value=""
                                    placeholder="Enter author name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value=""
                                    placeholder="Enter author email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Role</div>
                                <select class="form-select" value="">
                                    <option value="noSelected">---No selected---</option>
                                    <option value="0">Admin/Super Author</option>
                                    <option value="1">Author</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    value="" placeholder="Enter author password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmPassword"
                                    value="" placeholder="Enter confirm password">
                                @error('confirmPassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Authors
                        </h2>
                        <div class="text-muted mt-1">1-18 of 413 people</div>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <form action="{{route('author#authorsPage')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="search" class="form-control d-inline-block w-9 me-3" name="key" value="{{request('key')}}" placeholder="Search author…">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-author">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    New author
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (Session::has('createSuccess'))
                <div class="alert alert-green alert-tr fade show col-auto position-absolute end-0 opacity-90"
                    role="alert">
                    <strong>{{ Session::get('createSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-tr fade show col-auto position-absolute end-0 opacity-90"
                    role="alert">
                    <strong>{{ Session::get('deleteSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- Page body -->
        <div class="page-body">
            @if (count($authors) !== 0)
            <div class="container-xl">
                <div class="row row-cards">
                    @foreach ($authors as $author)
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body p-4 text-center">
                                    <span class="avatar avatar-xl mb-3 rounded"
                                        style="background-image: url({{ asset($author->profile_picture !== null ? 'storage/authorImage/' . $author->profile_picture : 'defaultImage/default.jpg') }})"></span>
                                    <h3 class="m-0 mb-1"><a href="#">{{ $author->name }}</a></h3>
                                    <div class="text-muted">{{ $author->email }}</div>
                                    <div class="mt-3">
                                        <span
                                            class="badge bg-purple-lt">{{ $author->role === 0 ? 'Admin/Super Author' : 'Author' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    {{-- <a href="" class="card-btn" data-bs-toggle="modal" data-bs-target="#edit-author-modal">
                                        <span class="text-primary">Edit</span>
                                    </a> --}}
                                    <a href="{{ route('author#deleteAuthor', $author->id) }}" class="card-btn disabled">
                                        <span class="text-danger">Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{$authors->appends(request()->query())->links()}}
                </div>
            </div>
            @else
            <div class="col-8 offset-2 position-relative" style="height: 400px">
                <h1 class="text-muted text-center position-absolute top-50">There is no author Here!</h1>
            </div>
            @endif
        </div>
    @endsection
    @push('scripts')
        <script>
            $(window).on('hidden.bs.modal', function() {
                Livewire.emit('resetForm');
            })
            window.addEventListener('hide-modal', function(event) {
                $('#add-author').modal('hide');
            })
        </script>
    @endpush
