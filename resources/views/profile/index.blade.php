@extends('layout.main')
@section('title', 'Profile')
@section('content')

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
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient-custom">
                    <h5 class="title">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" autocomplete="off" method="POST">
                        @csrf
                    @method('PUT')
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
                        
                        @if(auth()->user()->mahasiswa)
                        <div class="form-group">
                            <label>IPS</label>
                            <input type="text" class="form-control @error('ips') is-invalid @enderror" name="ips" value="{{ old('ips', $mahasiswa->ips) }}">
                            @error('ips')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror                        
                        </div>
                        @endif
                        <button type="submit" class="btn button-purple">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-gradient-custom">
                    <h5 class="title text-center">Photo Profile</h5>
                </div>
                <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group text-center"> 
                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar" style="display: none;">
                            <img class="avatar avatar-custom" src="{{ Auth::user()->avatar ? '/avatars/' . Auth::user()->avatar : '/image/default.jpg' }}" id="avatarPreview" style="cursor: pointer;">
                            <h5 class="title">{{ $user->name }}</h5>
                        </div>
                        <div class="form-group">    
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn button-purple">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
