<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BatchTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batchTest:exec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run tests for batch processing';

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
        echo date('YmdHis');
        // 条件を満たしたアイテムがあれば集計処理を実行する
    }
}
