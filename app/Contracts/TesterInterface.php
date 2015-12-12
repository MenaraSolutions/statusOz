<?php

namespace App\Contracts;

interface TesterInterface
{
    /**
     * Perform a test with a given parameter
     *
     * @param TestableSubjectInterface $subject
     *
     * @return float
     */
    public function perform(TestableSubjectInterface $subject);
}