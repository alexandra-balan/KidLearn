<?php

namespace Tests\Unit;

use App\Repositories\SubjectRepository;
use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectRepositoryTest extends TestCase
{

    public function testGet()
    {
        $subjectRepo = new SubjectRepository();
        $subject = factory(Subject::class)->create();

        $this->assertInstanceOf(Subject::class, $subjectRepo->get($subject->id));
    }

    public function testStore()
    {
        $subjectRepo = new SubjectRepository();
        $subject = factory(Subject::class)->create();

        $data = ['subject' => $subject->subject];
        $subjectRepo->store($data, []);

        $this->assertDatabaseHas('subjects', $data);

    }

    public function testAll()
    {
        $subjectRepo = new SubjectRepository();
        $subjects = $subjectRepo->all();

        $count1 = count($subjects);

        $subjectRepo->store(['subject' => 'TestAll'], []);
        $subjects = $subjectRepo->all();

        $count2 = count($subjects);

        $this->assertEquals($count2, $count1 + 1);

    }
}
