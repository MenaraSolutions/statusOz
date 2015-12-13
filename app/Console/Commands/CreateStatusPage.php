<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subject;
use Storage;
use Config;
use App;

class CreateStatusPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate status page with current figures';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Config::get('app.worker_id') != Config::get('app.generator_worker_id') && !App::isLocal()) return;

        $this->line('Generating status page...');

        $viewVariables =[
            'subjectGroups' => Subject::all()->groupBy('group'),
            'subjects' => Subject::all()
        ];

        Storage::disk('local')->put('status.html', view('index', $viewVariables));

        $this->line('Finished');
    }
}
