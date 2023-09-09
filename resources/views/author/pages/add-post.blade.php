@extends('author.layouts.app')
@section('title', 'Add Post')
@section('contents')
    <div class="page-header d-print-none mb-5">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title text-light">
                        Add New Post
                    </h1>
                </div>
                @if (Session::has('createSuccess'))
                    <div class="alert alert-green alert-tr fade show col-auto position-absolute end-0" role="alert">
                        <strong>{{ Session::get('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('author#createPost') }}" method="post" id="addPost" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Post Title</label>
                            <input type="text" class="form-control" name="postTitle" value="{{ old('postTitle') }}"
                                placeholder="Enter post title">
                            @error('postTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Content</label>
                            <textarea class="form-control" rows="8" name="postContent" placeholder="Content..." id="postContent">{{ old('postContent') }}</textarea>
                            @error('postContent')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-label">Post Category</div>
                            <select class="form-select" name="postCategory">
                                <option value="">--No Selected--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Post Image</div>
                            <input type="file" class="form-control" name="postImage" value="{{ old('postImage') }}">
                            @error('postImage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="text-danger" id="imgError"></span>
                        </div>
                        <div class="mb-3">
                            <img src="" class="img-thumbnail" style="width: 250px;" id="image-previewer"
                                data-ijabo-default-img="">
                        </div>
                        <button type="submit" class="btn btn-primary">Save post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script>
        $(function() {
            $('input[type="file"][name="postImage"]').ijaboViewer({
                preview: '#image-previewer',
                imageShape: '',
                allowedExtensions: ['jpg', 'jpeg', 'png', 'jfif', 'webp'],
                onErrorShape: function(message, element) {
                    if (message) {
                        $('#imgError').text(message);
                    } else {
                        $('#imgError').text('');
                    }
                },
                onInvalidType: function(message, elemint) {
                    if (message) {
                        $('#imgError').text(message);
                    } else {
                        $('#imgError').text('');
                    }
                }
            });

            ClassicEditor
                .create(document.querySelector('#postContent'))
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
@endpush
