<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\TrafficLog;
use App\User;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		//          ->hourly();

		// Conducted Coins from User every minute
		$schedule->call(function () {
			TrafficLog::where('counts', 0)->each(function ($log) {
				$coins = $log->upload * $log->upload_price + $log->download * $log->download_price; // @TODO convert byte to GB
				$user = $log->service->user->first();
				$user->coin = $user->coin - $coins;
				if ($user->save()) {
					$log->count = 1;
					$log->save();
				} else {
					Log::critical($user->id . 'failed to conducted Coins');
				}
			});
		})->everyMinute()->name('Conduct Coins From User Account')->withoutOverlapping();

	}

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		require base_path('routes/console.php');
	}
}
