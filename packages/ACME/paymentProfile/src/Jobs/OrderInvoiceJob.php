<?php

namespace ACME\paymentProfile\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use ACME\paymentProfile\Mail\OrderInvoice;
use Illuminate\Support\Facades\Log;

class OrderInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $pdfPath;
    public $agent;
    /**
     * Create a new job instance.
     */
    public function __construct($order,$agent,$pdfPath)
    {
        $this->order = $order;
        $this->pdfPath = $pdfPath;
        $this->agent = $agent;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // sandeep add code for send invoice mail
        if($this->order->fbo_email_address === null){
            $email = $this->order->customer_email;
        }else{
            $email = $this->order->fbo_email_address;
        }
        
        try{ 
            log::info('email',['email'=>$email]);
            Mail::to($email)->send(new OrderInvoice($this->order, $this->agent, $this->pdfPath));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
