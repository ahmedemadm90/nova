<?php

namespace App\Console\Commands;

use App\Models\Violation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AreaCommentComman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:areacomment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Area Responsible Comment After 24 Hrs Of Not Commenting On His Area Violations';

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
        $vios = Violation::whereNull('area_comment')->where('created_at', '<', Carbon::now()->addDay())->get();
        $vios->update([
            'area_comment' => 'No Comment From Area Responsible',
        ]);
        $vios->save();
    }
}