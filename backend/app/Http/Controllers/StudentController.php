<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"     => "required|min:3|max:50",
            "surname"  => "required|min:3|max:50",
            "group_id" => "required|exists:groups,id",
        ]);
        $student = new Student($request->all());
        $student->save();
        return response()->json(["message" => "Tələbə Yaradıldı.", "code" => 200], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(["message" => "Tələbə Silindi.", "code" => 200], 200);
        }
        return response()->json(["message" => "Tələbə Tapilmadi", "code" => 404], 404);
    }
}
