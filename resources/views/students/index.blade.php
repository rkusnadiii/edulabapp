@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Siswa</h2>

        <div class="mb-3">
            <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
        </div>

        <div class="table-responsive">
            <table id="students-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data from DataTables will be inserted here dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for DataTables -->
    <script>
        $(document).ready(function () {
            $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('students.data') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'class', name: 'class' },
                    { 
                        data: 'status', 
                        name: 'status', 
                        render: function(data, type, full, meta){
                            return data == 1 ? 'Aktif' : 'Tidak Aktif';
                        }
                    },
                    { data: 'action', name: 'action' },
                ],
            });
        });
    </script>
@endsection
