<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\TrafficLog;
use App\UserService;

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

		// Calculate Coins every minute
		$schedule->call(function () {
			TrafficLog::whereNull('coin')->each(function ($log) {
				$log->coin = byteToGB($log->upload) * $log->upload_price + byteToGB($log->download) * $log->download_price;
				$log->save();
			});
		})->everyMinute()->name('Calculate Coins')->withoutOverlapping();

		// Add Cost to Service
		$schedule->call(function () {
			TrafficLog::where([
				['counted', 0], ['coin', '<>', NULL],
			])->each(function($log){
				$service = $log->service;
				$service->temp_cost = $service->temp_cost + $log->coin;
				$log->counted = 1;
				$log->save();
				$service->save();
			});
		})->name('Add Cost To Service')->withoutOverlapping()->everyMinute();

		// Conducted Coins when available
		$schedule->call(function(){
			UserService::where('temp_cost','>=',0.01)->each(function($service){
				$service->total_cost = $service->total_cost + $service->temp_cost;
				$user = $service->user;
				$user->coin = $user->coin - $service->temp_cost;
				$user->save();
				$service->temp_cost = 0;
				$service->save();
			});
		})->name('Conducted Cost From User Account')->withoutOverlapping()->everyMinute();
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
