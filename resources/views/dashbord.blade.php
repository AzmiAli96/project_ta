@extends('layout.main')
@section('title', 'Dashboard')
@section('content')


    <div class="text-bg-warning p-3 rounded">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat nihil inventore ea corrupti? Magnam, voluptatem! Mollitia tempore natus ab quo libero quod nulla. Expedita tempora corrupti aspernatur, enim perspiciatis necessitatibus!</p>
    </div>



    <div class="row">
        <div class="col mb-4">
            <div class="card card-raised border-start border-primary border-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">user</h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-body-secondary"> {{ App\Models\Mahasiswa::count() }} user</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card card-raised border-start border-secondary border-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tugas Akhir</h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card card-raised border-start border-warning border-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Jadwal Sidang</h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card card-raised border-start border-success border-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Sidang Finish</h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>



    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>



@endsection