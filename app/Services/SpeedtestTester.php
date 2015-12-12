<?php

namespace App\Services;

use App\Contracts\TestableSubjectInterface;
use App\Contracts\TesterInterface;
use Symfony\Component\Process\Process;

class SpeedtestTester implements TesterInterface
{
    // Pattern to look for in the output
    protected $pattern = 'Upload: ';

    // Timeout in seconds
    protected $timeout = 120;

    /**
     * Perform a test with a given parameter
     *
     * @param TestableSubjectInterface $subject
     *
     * @return float|bool
     */
    public function perform(TestableSubjectInterface $subject)
    {
        $process = new Process(storage_path('/app/speedtest-cli --server ' . $subject->getTesterParameter()));
        $process->setTimeout($this->timeout)->run();

        if ($process->isSuccessful() && strpos($process->getOutput(), $this->pattern) !== false) {
            // Extract speed result from the command output
            $speed = substr($process->getOutput(),
                strpos($process->getOutput(), $this->pattern) + mb_strlen($this->pattern));

            return floatval(substr($speed, 0, strpos($speed, ' ')));
        } else {
            return false;
        }
    }
}