<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUnpaidTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:unpaid-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unpaid transactions after 1 hour';

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
        if (licenceType(2)) {
            $transactions = Transaction::where('created_at', '<', Carbon::now()->subHour())->whereIn('status', [0, 1])->get();
            foreach ($transactions as $transaction) {
                $transaction->delete();
            }
        }
    }
}
