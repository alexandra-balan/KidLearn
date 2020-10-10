<?php

namespace App\Repositories;

interface StudentClassesRepositoryInterface
{
    public function get($subject_id);

    public function all();

    public function store(array $data);

    public function delete($subject_id);

    public function update($subject_id, array $subject_data);

    public function getClassByName($class);

    public function semiAnnualReport($id);

    public function annualReport($id);

    public function classGraduationRate($id);

    public function totalGraduationRate();

    public function graduationRate($id);
}