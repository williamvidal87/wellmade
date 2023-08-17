<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Logout;//
use App\Listeners\LogSuccessfulLogout;//
use App\Models\BillingSupplier;
use App\Models\CheckVoucher;
use App\Models\ClientProfile;
use App\Models\CounterReceipt;
use App\Models\JobOrder;
use App\Models\ServiceInvoice;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use App\Observers\CheckVoucherObserver;
use App\Observers\ClientContactObserver;
use App\Observers\CounterReceiptObserver;
use App\Observers\JoAcknowledgementReceiptObserver;
use App\Observers\JobOrderObserver;
use App\Observers\ServiceInvoiceObserver;
use App\Observers\SupplierObserver;
use App\Observers\TransactionParticularObserver;
use App\Observers\TransactionSummaryObserver;
use App\Observers\WorkOrderObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,            
        ],
       
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],
        
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
        ],   
        
       
    
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        TransactionSummary::observe(TransactionSummaryObserver::class);
        JobOrder::observe(JoAcknowledgementReceiptObserver::class);
        CounterReceipt::observe(CounterReceiptObserver::class);
        BillingSupplier::observe(SupplierObserver::class);
        CheckVoucher::observe(CheckVoucherObserver::class);
        TransactionParticular::observe(TransactionParticularObserver::class);
        ClientProfile::observe(ClientContactObserver::class);
        JobOrder::observe(JobOrderObserver::class);
        WorkOrder::observe(WorkOrderObserver::class);
    }
}
