<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('name');
        $student->class = $request->input('class');
        $student->status = $request->input('status');
        $student->save();

        return response()->json($student);
    }

    public function updateStatus($id)
    {
        if (!request()->ajax() || !request()->isMethod('DELETE') || !request()->header('X-CSRF-TOKEN')) {
            abort(403, 'Unauthorized action.');
        }
        $student = Student::findOrFail($id);
        $student->status = !$student->status;
        $student->save();

        return response()->json($student);
    }

    public function destroy($id)
    {
        if (!request()->ajax() || !request()->isMethod('DELETE') || !request()->header('X-CSRF-TOKEN')) {
            abort(403, 'Unauthorized action.');
        }
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
    public function getData()
{
    $students = Student::select(['id', 'name', 'class', 'status'])->get();

    $data = [];
    foreach ($students as $student) {
        $data[] = [
            'id' => $student->id,
            'name' => $student->name,
            'class' => $student->class,
            'status' => $student->status,
            'action' => '<button class="btn btn-danger" onclick="deleteStudent('.$student->id.')">Hapus</button>',
        ];
    }

    // Return the formatted data as JSON
    return response()->json(['data' => $data]);
}
}
