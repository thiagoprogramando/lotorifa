<?php

namespace App\Jobs;

use App\Models\Bet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessWebhook implements ShouldQueue {
    use Dispatchable;
    
    public $jsonData;

    public function __construct($jsonData) {

        $this->jsonData = $jsonData;
    }

    public function handle() {

        if ($this->jsonData['event'] === 'PAYMENT_CONFIRMED' || $this->jsonData['event'] === 'PAYMENT_RECEIVED') {
            $token = $this->jsonData['payment']['id'];

            $bets = Bet::where('token', $token)->get();
            foreach ($bets as $bet) {
                $bet->status = 'PAYMENT_CONFIRMED';
                $bet->save();
            }
        }
    }
}