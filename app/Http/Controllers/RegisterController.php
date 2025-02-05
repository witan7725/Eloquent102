<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;
use App\Models\Register;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedTable = $request->input('selectedTable', 1);
        $searchQuery = $request->input('search', '');
        $table = Course::query();

        // เลือกตารางตามที่ผู้ใช้เลือก
        if ($selectedTable == 1) {
            $table = Course::query();
        } else if ($selectedTable == 2) {
            $table = Student::query();
        } else if ($selectedTable == 3) {
            $table = Teacher::query();
        } else if ($selectedTable == 4) {
            $table = Register::query();
        }

        // ค้นหาข้อมูลตามคำค้นหา
        if ($searchQuery) {
            $table->where(function ($query) use ($searchQuery, $selectedTable) {
                if ($selectedTable == 1) {
                    $query->where('course_code', 'like', "%{$searchQuery}%")
                          ->orWhere('course_name', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 2) {
                    $query->where('student_id', 'like', "%{$searchQuery}%")
                          ->orWhere('name', 'like', "%{$searchQuery}%")
                          ->orWhere('major', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 3) {
                    $query->where('name', 'like', "%{$searchQuery}%")
                          ->orWhere('department', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 4) {
                    $query->where('student_id', 'like', "%{$searchQuery}%")
                          ->orWhere('course_id', 'like', "%{$searchQuery}%")
                          ->orWhere('semester', 'like', "%{$searchQuery}%");
                }
            });
        }

        $table = $table->paginate(10);

        return Inertia::render('Registers/Index', [
            'table' => $table,
            'tableNo' => $selectedTable,
            'searchQuery' => $searchQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ดึงข้อมูล major ที่ไม่ซ้ำจากตาราง student
        $majors = Student::distinct()->pluck('major');

        // ดึงข้อมูล department ที่ไม่ซ้ำจากตาราง teacher
        $departments = Teacher::distinct()->pluck('department');

        return Inertia::render('Registers/Create', [
            'majors' => $majors,
            'departments' => $departments
        ]);
    }

    /**
     * แสดงเมนูแก้ไข
     */
    public function editMenu(Request $request)
    {
        $selectedTable = $request->input('selectedTable', 1);
        $searchQuery = $request->input('search', '');
        $table = Course::query();

        // เลือกตารางตามที่ผู้ใช้เลือก
        if ($selectedTable == 1) {
            $table = Course::query();
        } else if ($selectedTable == 2) {
            $table = Student::query();
        } else if ($selectedTable == 3) {
            $table = Teacher::query();
        } else if ($selectedTable == 4) {
            $table = Register::query();
        }

        // ค้นหาข้อมูลตามคำค้นหา
        if ($searchQuery) {
            $table->where(function ($query) use ($searchQuery, $selectedTable) {
                if ($selectedTable == 1) {
                    $query->where('course_code', 'like', "%{$searchQuery}%")
                          ->orWhere('course_name', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 2) {
                    $query->where('student_id', 'like', "%{$searchQuery}%")
                          ->orWhere('name', 'like', "%{$searchQuery}%")
                          ->orWhere('major', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 3) {
                    $query->where('name', 'like', "%{$searchQuery}%")
                          ->orWhere('department', 'like', "%{$searchQuery}%");
                } else if ($selectedTable == 4) {
                    $query->where('student_id', 'like', "%{$searchQuery}%")
                          ->orWhere('course_id', 'like', "%{$searchQuery}%")
                          ->orWhere('semester', 'like', "%{$searchQuery}%");
                }
            });
        }

        $table = $table->paginate(10);

        return Inertia::render('Registers/Edit', [
            'table' => $table,
            'tableNo' => $selectedTable,
            'searchQuery' => $searchQuery,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'student_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'major' => 'required|string|max:255',
        ]);

        // สร้างข้อมูลนักศึกษาใหม่
        Student::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'age' => $request->age,
            'major' => $request->major,
        ]);

        return redirect()->route('registers.index')->with('success', 'Student created successfully.');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function storeTeacher(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ]);

        // สร้างข้อมูลครูใหม่
        Teacher::create([
            'name' => $request->name,
            'department' => $request->department,
        ]);

        return redirect()->route('registers.index')->with('success', 'Teacher created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // ค้นหาข้อมูลนักศึกษาและครูตาม ID
        $student = Student::find($id);
        $teacher = Teacher::find($id);

        return Inertia::render('Registers/EditForm', [
            'student' => $student,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ตรวจสอบและอัปเดตข้อมูลนักศึกษา
        if ($request->has('student_id')) {
            $request->validate([
                'student_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'major' => 'required|string|max:255',
            ]);

            $student = Student::find($id);
            $student->update([
                'student_id' => $request->student_id,
                'name' => $request->name,
                'age' => $request->age,
                'major' => $request->major,
            ]);

            return redirect()->route('registers.index')->with('success', 'Student updated successfully.');
        }

        // ตรวจสอบและอัปเดตข้อมูลครู
        if ($request->has('department')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'department' => 'required|string|max:255',
            ]);

            $teacher = Teacher::find($id);
            $teacher->update([
                'name' => $request->name,
                'department' => $request->department,
            ]);

            return redirect()->route('registers.index')->with('success', 'Teacher updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ค้นหาข้อมูลนักศึกษาและครูตาม ID
        $student = Student::find($id);
        $teacher = Teacher::find($id);

        // ลบข้อมูลนักศึกษา
        if ($student) {
            $student->delete();
            return redirect()->route('registers.index')->with('success', 'Student deleted successfully.');
        }

        // ลบข้อมูลครู
        if ($teacher) {
            $teacher->delete();
            return redirect()->route('registers.index')->with('success', 'Teacher deleted successfully.');
        }
    }
}
