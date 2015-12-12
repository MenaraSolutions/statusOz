<?php

namespace App\Contracts;

interface SubjectsCollectionInterface
{

    /**
     * Return an array of subjects that should be processed by worker with given ID
     *
     * @param $workerId
     *
     * @return array TestableSubjectInterface
     */
    public function getSubjectsByWorkerId($workerId);
}