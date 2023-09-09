@extends('user.layouts.app')
@section('postTitle', 'Profile')
@section('content')
    <div class="col-12 col-sm-12 col-lg-8 offset-lg-2">
        <div class="widget">
            <div class="widget-body">
                <div class="card">
                    <div class="row">
                        <h2 class="section-title col-12 col-lg-3">My Profile</h2>
                        @if (Session::has('updateSuccess'))
                            <div class="alert alert-warning col-12 offset-lg-2 col-lg-auto" role="alert">
                                {{ Session::get('updateSuccess') }}
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form class="form-horizontal" action="{{ route('user#updateProfile') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('userName') is-invalid @enderror" id="inputName"
                                                name="userName" placeholder="Enter Name..."
                                                value="{{ old('userName', $user->name) }}">
                                            @error('userName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email"
                                                class="form-control @error('userEmail') is-invalid @enderror"
                                                id="inputEmail" name="userEmail" placeholder="Enter Email..."
                                                value="{{ old('userEmail', $user->email) }}">
                                            @error('userEmail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Bio</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control"@error('userBio') is-invalid @enderror cols="30" rows="10"
                                                placeholder="Content..." name="userBio">{{ old('userBio', $user->bio) }}</textarea>
                                            @error('userBio')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="{{ route('user#changePasswordPage') }}">Change Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
