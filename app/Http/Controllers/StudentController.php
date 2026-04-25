<?php

namespace App\Http\Controllers;

use App\Service\StudentService;
use Illuminate\Http\Request;

class StudentController
{
    public function __construct(
        private StudentService $student
    ) {}

    public function show()
    {
        return $this->student->get();
    }

    public function create(Request $request)
    {
        $data = $request->only(['name', 'course', 'age']);

        return $this->student->create($data);
    }

    public function delete($id)
    {
        return $this->student->delete($id);
    }
}
