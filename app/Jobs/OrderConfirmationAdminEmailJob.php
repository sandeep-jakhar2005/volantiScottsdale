<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use ACME\paymentProfile\Mail\adminOrderNotification;
use Illuminate\Support\Facades\Log;
use Webkul\User\Models\Admin;

class OrderConfirmationAdminEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        $this->order = $order;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // send admin order confirmation mail
        $admins = Admin::select('name', 'email')->where('role_id','1')->get();
        $order = $this->order;
        foreach ($admins as $admin) {
            try {
                Mail::to($admin->email)->send(new AdminOrderNotification($order, $admin->name));
                Log::info('Email sent successfully to: ' . $admin->email);
            } catch (\Exception $e) {
                Log::error('Failed to send email to: ' . $admin->email, [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
    }
}
