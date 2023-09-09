@extends('author.layouts.app')
@section('title', 'profile')
@section('contents')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-md"
                    style="background-image: url({{ Auth::user()->profile_picture === null ? asset('defaultImage/default.jpg') : asset('storage/authorImage/' . Auth::user()->profile_picture) }})"></span>
            </div>
            <div class="col-6">
                <h2 class="page-title text-white">{{ $author->name }}</h2>
                <div class="page-subtitle">
                    <div class="row">
                        <div class="col-auto">
                            <span
                                class="badge bg-red-lt">{{ $author->role === 0 ? 'Admin/Super Author' : 'Author' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 d-md-flex">
                <input type="file" name="file" id="changeAuthorPictureFile" class="d-none"
                    onchange="this.dispatchEvent(new InputEvent('input'))">
                <a href="#" class="btn btn-primary"
                    onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
                    Change Picture
                </a>
            </div>
            {{-- <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-status bg-info"></div>
                        <div class="modal-body text-center py-4">
                            <div class="row">
                                <div class="col-5"><img
                                        src="{{ Auth::user()->profile_picture === null ? asset('defaultImage/default.jpg') : asset('author/static/tracks/eb33214151082431206ab6e1ad4bbf83f487d58e.jpg') }}"
                                        alt=""></div>
                                <div class="col-7 text-center">
                                    <input type="file" class="form-control" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                            Cancel
                                        </a></div>
                                    <div class="col"><a href="#" class="btn btn-primary w-100"
                                            data-bs-dismiss="modal">
                                            Save
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            @if (Session::has('updateSuccess'))
                <div class="alert alert-green alert-tr fade show col-auto position-absolute end-0 opacity-90"
                    role="alert">
                    <strong>{{ Session::get('updateSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-profile-ex1" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-password-ex1" class="nav-link" data-bs-toggle="tab">Change Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-profile-ex1">
                        <form action="{{ route('author#updateDetails') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control @error('authorName') is-invalid @enderror"
                                            name="authorName" value="{{ old('authorName', $author->name) }}"
                                            placeholder="Enter your name">
                                        @error('authorName')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('authorEmail') is-invalid @enderror"
                                            name="authorEmail" value="{{ old('authorEmail', $author->email) }}"
                                            placeholder="Enter your email">
                                        @error('authorEmail')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control @error('authorBio') is-invalid @enderror" name="authorBio" rows="6"
                                            placeholder="Content..">{{ old('authorBio', $author->bio) }}</textarea>
                                        @error('authorBio')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tabs-password-ex1">
                        @livewire('author.change-password')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#changeAuthorPictureFile').ijaboCropTool({
            preview: '',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png', 'jfif'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: "{{ route('author#changeProfilePicture') }}",
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                if(status === 1){
                    window.location.href = '/author/profile';
                }
            },
            onError: function(message, element, status) {
                window.location.href = '/author/profile';
            }
        });
    </script>
@endpush
