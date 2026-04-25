<?php

namespace App\Service;

use App\Repositories\StudentRepository;

class StudentService
{
    // dependency injection
    public function __construct(
        private StudentRepository $studentRepository
    ) {}

    public function get()
    {
        return $this->studentRepository->getStudents();
    }

    public function create($data)
    {
        return $this->studentRepository->createStudent($data);
    }

    public function delete($id)
    {
        return $this->studentRepository->deleteStudent($id);
    }
}
