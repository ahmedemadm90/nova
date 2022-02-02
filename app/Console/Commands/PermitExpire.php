<?php

namespace App\Console\Commands;

use App\Models\UnfixedPermit;
use App\Models\UnfixedService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PermitExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:permitexpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unfixed Permit Expiration';

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
     * @return int
     */
    public function handle()
    {
        $permits = UnfixedPermit::where('end_date', '<=', Carbon::today()->toDateString())->get();
        foreach ($permits as $permit) {
            $permit->update([
                'active' => '0',
            ]);
            foreach ($permit->workers_ids as $id) {
                $emp = UnfixedService::find($id);
                $emp->update([
                    'active' => '1',
                    'company_id' => null,
                    'permit_id' => null,
                ]);
            }
        }
    }
}