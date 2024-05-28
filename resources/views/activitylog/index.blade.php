@extends('layout.main')
@section('title', 'Mahasiswa')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Log Aktivitas</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Log Aktivitas</h6>
    </div>

    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/activity" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" value="{{ request('search') }}" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity )
                    <tr>
                        <td>{{$activity->id}}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at }}</td>
                        
                    </tr>
                    @endforeach
            </table>
            {{ $activities->links() }}
        </div>
    </div>
</div>


@endsection