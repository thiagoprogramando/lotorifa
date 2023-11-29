<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Bet;

class ClearPendingBets extends Command
{

    protected $signature = 'app:clear-pending-bets';

    protected $description = 'Clear pending bets older than 15 minutes';

    public function handle()
    {

        $this->info('Clearing pending bets...');

        $bets = Bet::where('status', 'PENDING')
            ->where('updated_at', '<=', Carbon::now()->subMinutes(15))
            ->get();

        foreach ($bets as $bet) {
            $bet->update([
                'id_user' => null,
                'token' => null,
                'dueDate' => null,
                'invoiceUrl' => null,
            ]);
        }

        $this->info('Pending bets cleared successfully.');
    }
}
