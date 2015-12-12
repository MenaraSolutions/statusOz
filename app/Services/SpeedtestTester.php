<?php

namespace App\Services;

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
     * @param string|integer $parameter
     *
     * @return float|bool
     */
    public function perform($parameter)
    {
        $process = new Process(storage_path('/app/speedtest-cli --server ' . $parameter));
        $process->setTimeout($this->timeout)->run();

        if ($process->isSuccessful()) {
            // Extract speed result from the command output
            $speed = substr($process->getOutput(),
                strpos($process->getOutput(), $this->pattern) + mb_strlen($this->pattern));

            return floatval(substr($speed, 0, strpos($speed, ' ')));
        } else {
            return false;
        }
    }
}