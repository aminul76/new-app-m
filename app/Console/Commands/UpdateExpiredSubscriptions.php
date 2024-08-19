<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CourseSubscribe; // Assuming you have a CourseSubscribe model
use Carbon\Carbon;

class UpdateExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of expired subscriptions to deactivated';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date and time
        $now = Carbon::now();

        // Find all subscriptions where the expiry date has passed and the status is still active (1)
        $expiredSubscriptions = CourseSubscribe::where('expires_at', '<=', $now)
                                               ->where('status', 1)
                                               ->get();

        // Loop through each expired subscription and update the status to 2 (deactivated)
        foreach ($expiredSubscriptions as $subscription) {
            $subscription->status = 2;
            $subscription->save();
        }

        // Provide some feedback
        $this->info('Expired subscriptions have been deactivated.');
    }
}
