@extends('layout.main')
@section('title', 'test')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Dosens</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($dsn as $dosen)
                    <tr>
                        <td> {{ $dsn->firstItem()+$loop->index }}</td>
                        <td> {{ $dosen->nidn }}</td>
                        <td> {{ $dosen->nama }}</td>
                        <td> {{ $dosen->email }}</td>
                        <td> {{ $dosen->level }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $dsn->links() }}
        </div>
    </div>
</div>
</div>
</div>
</main>
</body>




@endsection