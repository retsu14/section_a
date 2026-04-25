<?php

namespace App\Repositories;

use App\Models\Students;

class StudentRepository
{
    public function getStudents()
    {
        return Students::all();
    }

    public function createStudent($data)
    {
        return Students::create($data);
    }

    public function deleteStudent($id)
    {
        $student = Students::findOrfail($id);

        return $student->delete();
    }

    // update student

}
