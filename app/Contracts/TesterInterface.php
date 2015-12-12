<?php

namespace App\Contracts;

interface TesterInterface
{
    /**
     * Perform a test with a given parameter
     *
     * @param string|integer $parameter
     *
     * @return float
     */
    public function perform($parameter);
}