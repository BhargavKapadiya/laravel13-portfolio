<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\NotificationService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $receivers;
    protected $text;
    protected $title;
    protected $type;
    protected $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receivers, $text, $title, $type, $params)
    {
        $this->receivers = $receivers;
        $this->text = $text;
        $this->title = $title;
        $this->type = $type;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        NotificationService::sendPushNotifications($this->receivers, $this->text, $this->title, $this->type, $this->params);
    }
}
