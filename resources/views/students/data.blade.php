@extends('layouts.app')

@section('content')

@foreach($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->class }}</td>
        <td>
            <label class="switch">
                <input type="checkbox" data-id="{{ $student->id }}" {{ $student->status == 1 ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </td>
        <td>
            <button class="btn btn-danger" onclick="deleteStudent({{ $student->id }})">Hapus</button>
        </td>
    </tr>
@endforeach

<script>
    $(document).ready(function () {
        $('#students-table').DataTable();

        $('.switch input[type="checkbox"]').change(function () {
            var studentId = $(this).data('id');
            updateStudentStatus(studentId, this.checked);
        });
    });

    function updateStudentStatus(id, status) {
        $.ajax({
            type: 'PUT',
            url: '{!! route('students.updateStatus') !!}',
            data: { _token: "{{ csrf_token() }}", status: status },
            success: function (data) {
                $('#students-table').DataTable().ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function deleteStudent(id) {
        if (confirm('Apakah Anda yakin ingin menghapus siswa ini?')) {
            $.ajax({
                type: 'DELETE',
                url: '{!! route('students.delete') !!}',
                data: { _token: "{{ csrf_token() }}" },
                success: function (data) {
                    $('#students-table').DataTable().ajax.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    }
</script>
