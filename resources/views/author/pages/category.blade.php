@extends('author.layouts.app')
@section('title','categories')
@section('contents')
<div class="row mt-5">
    @if (Session::has('createSuccess'))
        <div class="alert alert-green alert-tr fade show col-auto position-absolute end-0 opacity-90"
            role="alert">
            <strong>{{ Session::get('createSuccess') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('updateSuccess'))
        <div class="alert alert-warning alert-tr fade show col-auto position-absolute end-0 opacity-90"
            role="alert">
            <strong>{{ Session::get('updateSuccess') }}</strong>
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
    @livewire('author.categories')
</div>
@endsection
