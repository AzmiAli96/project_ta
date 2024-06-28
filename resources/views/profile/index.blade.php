@extends('layout.main')
@section('title', 'Profile')
@section('content')



{{-- <div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Profile</h5>
                </div>
                <form method="post" action="https://black-dashboard-laravel.creative-tim.com/profile" autocomplete="off">
                    <div class="card-body">
                        <input type="hidden" name="_token" value="TKAmd0RaK7a8uQsSk09EZmnUIdL8jlMSG4uL63TV" autocomplete="off">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Password" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" value="update">Ubah</button>
                    </div>
                </form>
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text"></p>
                    <div class="text-center">
                        <a href="#">
                            @php
                                $user = Auth::user();
                                $photo = $user->photo ?? 'default-user.png';
                            @endphp
                            <img class="avatar rounded-circle custom-avatar" src="{{ asset('photo/' . $photo) }}" alt="User Profile Picture">
                            <h5 class="title">{{ $user->name }}</h5>
                        </a>
                    </div>
                    <p></p>
                    <div class="card-description">
                        Do not be scared of the truth because we need to restart the human foundation in truth
                        And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="content">
    <div class="row">
        <div class="col-md-12">
            @if(session('pesan'))
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header color-lemon">
                    <h5 class="title">Edit Profile</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <small>Leave blank to keep current password</small>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header color-lemon">
                    <h5 class="title text-center">Photo Profile</h5>
                </div>
                <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group text-center"> 
                            {{-- <img class="avatar rounded-circle custom-avatar" src="/avatars/{{ Auth::user()->avatar }}" style=""> --}}
                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar" style="display: none;">
                            <img  class="avatar avatar-border avatar-size" src="/avatars/{{ Auth::user()->avatar }}" id="avatarPreview" style="cursor: pointer;">

                            <h5 class="title">{{ $user->name }}</h5>
                        </div>
                        <div class="form-group">    
                                {{-- <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar"> --}}
    
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </div>
                </form>
                    
            </div>
        </div>
       

        
        {{-- <div class="card-body">
            <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                @csrf

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

                    <div class="col-md-6">
                        <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar">

                        <img src="/avatars/{{ Auth::user()->avatar }}" style="width:80px;margin-top: 10px;">

                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Upload Profile') }}
                        </button>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
</div>

{{-- JS-Pilih File Gambar --}}
<script>
    document.getElementById('avatarPreview').addEventListener('click', function() {
        document.getElementById('avatar').click();
    });

    document.getElementById('avatar').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>


@endsection