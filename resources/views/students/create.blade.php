@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Siswa</h2>
        <form id="create-student-form">
            @csrf
            <div class="form-group">
                <label for="name">Nama Siswa:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="class">Kelas:</label>
                <select class="form-control" id="class" name="class" required>
                    <option value="9">Kelas 9</option>
                    <option value="10">Kelas 10</option>
                    <option value="11">Kelas 11</option>
                    <option value="12">Kelas 12</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Non Aktif</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" onclick="addStudent()">Tambah Siswa</button>
        </form>
    </div>

    <!-- JavaScript for Adding Student via Ajax -->
    <script>
        function addStudent() {
            $.ajax({
                type: 'POST',
                url: '{!! route('students.store') !!}',
                data: $('#create-student-form').serialize(),
                success: function (data) {
                    $('#students-table').DataTable().ajax.reload();
                    $('#create-student-form')[0].reset();

                    window.location.href = '{!! route('students.index') !!}';
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
@endsection
