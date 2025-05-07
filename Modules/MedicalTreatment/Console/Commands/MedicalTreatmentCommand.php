<?php

namespace Modules\MedicalTreatment\Console\Commands;

use Illuminate\Console\Command;

class MedicalTreatmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MedicalTreatmentCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MedicalTreatment Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
