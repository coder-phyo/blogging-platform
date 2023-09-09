@extends('user.layouts.app')
@section('postTitle', 'Profile')
@section('content')
    <div class="col-12 col-sm-12 col-lg-8 offset-lg-2">
        <div class="widget">
            <div class="widget-body">
                <div class="card">
                    <div class="row">
                        <h2 class="section-title">Change Password</h2>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form class="form-horizontal" action="{{ route('user#changePassword') }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Old</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control " id="inputName" name="oldPassword"
                                                placeholder="Enter your old password...">
                                            @error('oldPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">New</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control " id="inputEmail" name="newPassword"
                                                placeholder="Enter your new password...">
                                            @error('newPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Confirm</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control " id="inputEmail"
                                                name="confirmPassword" placeholder="Enter confirm password...">
                                            @error('confirmPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Change
                                                Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
