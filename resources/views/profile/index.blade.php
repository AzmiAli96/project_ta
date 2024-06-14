@extends('layout.main')
@section('title', 'Mahasiswa')
@section('content')

<div class="card-body">
    <div class="col-12">
        <div class="profile-picture">
            <div class="card" style="width: 18rem;">
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('image/' . auth()->user()->image) }}"  alt="User Picture">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection