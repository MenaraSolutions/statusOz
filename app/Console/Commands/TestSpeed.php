<?php

namespace App\Console\Commands;

use App\Contracts\SubjectsCollectionInterface;
use App\Contracts\TesterInterface;
use Illuminate\Console\Command;
use Config;

class TestSpeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test speed from current machine';

    /**
     * @param SubjectsCollectionInterface $subjects
     * @param TesterInterface $tester
     */
    public function handle(SubjectsCollectionInterface $subjects, TesterInterface $tester)
    {
        $mySubjects = $subjects->getSubjectsByWorkerId(Config::get('app.worker_id'));

        $this->info('Got ' . count($mySubjects) . ' subjects to test');

        foreach($mySubjects as $subject) {
            $this->line('Running test on ' . $subject->title);

            $result = $tester->perform($subject);

            if ($result !== false) {
                $subject->tests()->create([
                    'result' => $result,
                    'worker_id' => Config::get('app.worker_id')
                ]);
            }
        }
    }
}
