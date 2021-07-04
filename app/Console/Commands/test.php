<?php

namespace App\Console\Commands;

use App\Repositories\EmployeeRepository;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-ed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employeeRepository = new EmployeeRepository();
        $response = $employeeRepository->getEmployeesByCriteria(10,0);
        dd($response->toArray());
        return 0;
    }
}
