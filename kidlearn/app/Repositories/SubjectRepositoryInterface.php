<?php

namespace App\Repositories;

interface SubjectRepositoryInterface
{
    public function get($subject_id);

    public function all();

    public function store(array $data, array $classes);

    public function delete($subject_id);

    public function update($subject_id, array $subject_data);

}