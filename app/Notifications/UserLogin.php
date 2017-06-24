<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Telegram\Bot\Api;

class UserLogin extends Notification
{
	use Queueable;

	public $user;
	public $ipAddress;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $ipAddress)
	{
		//
		$this->user = $user;
		$this->ipAddress = $ipAddress;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['telegram'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->line('The introduction to the notification.')
			->action('Notification Action', url('/'))
			->line('Thank you for using our application!');
	}

	public function toTelegram($notifiable)
	{
		return ((new Api)->sendMessage([
			'chat_id' => $this->user->telegram_id,
			'message' => 'IP:'.$this->ipAddress.'Just Login into Your Account.'
		]));
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}
