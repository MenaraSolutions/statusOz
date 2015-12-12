<?php

namespace App\Contracts;

interface TestableSubjectInterface
{
    /**
     * ID of this subject for testing purposes
     *
     * @return string|integer
     */
    public function getTesterParameter();
}