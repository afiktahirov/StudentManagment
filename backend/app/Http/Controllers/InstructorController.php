<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructor = Instructor::all();
        $instructor_group = $instructor->load('groups');
        return response()->json($instructor_group);
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
            'name' => 'required|min:3|max:50',
            'surname' => 'required|min:3|max:50',
        ]);
        $instructor = new Instructor($request->all());
        $instructor->save();
        $instructorId = $instructor->id;
        DB::table('group_instructor')->insert([
            'group_id' => $request->group_id,
            'instructor_id' => $instructorId,
        ]);
        $groups = $instructor->groups;
        return response()->json(['message' => 'Muellim Yaradildi.', 'code' => 200, 'instructor' => $instructor, 'groups' => $groups], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $instructor = Instructor::find($id);
        $groups = $instructor->groups;
        if ($instructor) {
            $instructor->delete();

            foreach ($groups as $group) {
                DB::table('group_instructor')
                    ->where('group_id', $group->id)
                    ->where('instructor_id', $id)
                    ->delete();
            }
            return response()->json(['message' => 'Muellim Silindi', 'code' => 200], 200);
        } else {
            return response()->json(['message' => 'Muellim Tapilmadi', 'code' => 404], 404);
        }
    }
}
