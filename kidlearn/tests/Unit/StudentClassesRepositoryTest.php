<?php

namespace Tests\Unit;

use App\Repositories\StudentClassesRepository;
use App\Student;
use App\StudentClasses;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentClassesRepositoryTest extends TestCase
{

    public function testHasManyStudents()
    {
        $studentClasses = factory(StudentClasses::class)->create();
        $students = factory(Student::class, 3)->create(['class_id' => $studentClasses->id]);

        foreach ($students as $student)
        {
            $this->assertInstanceOf(StudentClasses::class, $student->classes);
        }

        $this->assertEquals(3, count($studentClasses->students()->get()->toArray()));
    }

    public function testGet()
    {
        $studentClassesRepo = new StudentClassesRepository();
        $studentClasses = factory(StudentClasses::class)->create();

        $this->assertInstanceOf(StudentClasses::class, $studentClassesRepo->get($studentClasses->id));
    }

    public function testStore()
    {
        $studentClassesRepo = new StudentClassesRepository();
        $studentClasses = factory(StudentClasses::class)->create();

        $data = ['year' => $studentClasses->year,
            'label' => $studentClasses->label];
        $studentClassesRepo->store($data);

        $this->assertDatabaseHas('studentClasses', $data);
    }
}
