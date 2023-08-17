<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserRoleCanOnlyAccessTo
{
   
    public function handle(Request $request, Closure $next)
    {       
        
        try {
            $userAccess = auth()->user()->roles->pluck('name')->first();
            $currentRouteName = Route::currentRouteName();
        
            if(in_array($currentRouteName, $this->userAccessRole()[$userAccess])) {
    
                return $next($request);

            }else{
                abort(403, 'Unauthorized action.');
        
            }
        }catch (\Exception $e) {
            abort(403, 'Unauthorized action.');
         
        }
      
       
    }
    /**
     * 
     * 
     * user with roles allowed to access
     * 
     */
    private function userAccessRole()
    {
        return [
            'Super Admin'=>[
                'dashboard',
                //crm
                'client-contact',
                'contact-incentives-logs',
                'client-report-listing',
                //ums
                'user-profile',
                'user-logs',
                'user-report-listing',
                //inventory
                'stock-management',
                'procurement-management',
                'supplier-record',
                'request-tools-supplies',
                'inventory-report-listing',
                'report-listing',
                'purchase-history',
                'daily-shop-supplies-report',
                'daily-maintenance-report',
                //jom
                'job-order',
                'approved-jo-order',
                'job-order-incentives',
                'job-order-receipts',
                'job-order-incentive-scan',
                'job-order-original-receipt',
                'job-order-duplicate-receipt',
                'job-order-triplicate-receipt',
                'job-order-used-parts',
                //work load management
                'mf-work-order',
                'supervisor-approval',
                'print-work-order',
                // 'report-listing',
            //billing and accounting
                //Genera Ledger
                'billing-chart-accounts',
                //accounts payable
                'supplier',
                'check-voucher',
                //accounts receivable
                'jo-acknowledgement-receipt',
                'service-invoice',
                'receipts-payments',
                'counter-receipts',
                'payment-logs',
                'payment-report',
            //misc
                //work load settings
                'general-procedure',
                'process-group',
                'process-sub-group',
                'specification',
                'scope',
                'scope-description',
                'sub-group',
                'sub-group-rate',
                'work-sub-type',
                'work-status',
                //engine settings
                'cylinder-list',
                'category-list',
                'engine-category',
                'engine-model',
                'egine-parts',
                'machine-list',
                'make-list',
                'unit-model',
                'unit-model-list',
                'valve',
                //crm settings
                'client-type',
                'csa-type',
                'contact-person',
                //billing settings
                'billing-account-type',
                'billing-chart-accounts',
                'billing-invoice-type',
                'incentive-type',
                'billing-transaction-types',
                'type-of-payment',
                'receipt-for',
                'for',
                'receipt-type',
                'bank',
                'voucher-type',
                //auth settings
                'roles',
                'permissions',
                //other settings
                'branch',
                'discounts',
                'status',
                'holiday',
                //Reports
                'daily-reconciliation',
                'operator-monthly-efficiency-report',
                'weekly-revenue-by-category-csa',
                'monthly-complience-report',
                'weekly_revenue_generated_with_deductions',
                'daily-operator',
                'weekly-revenue-csa',
                'monthly-industry-customer-report',
                'revenue-generated-by-invoice-type',
            ],
            'Admin' => [
                'dashboard',
                //crm
                'client-contact',
                'contact-incentives-logs',
                'client-report-listing',
                //ums
                'user-profile',
                'user-logs',
                'user-report-listing',
                //inventory
                'stock-management',
                'procurement-management',
                'supplier-record',
                'request-tools-supplies',
                'inventory-report-listing',
                'report-listing',
                'purchase-history',
                'daily-shop-supplies-report',
                'daily-maintenance-report',
                //jom
                'job-order',
                'approved-jo-order',
                'job-order-incentives',
                'job-order-receipts',
                'job-order-incentive-scan',
                'job-order-original-receipt',
                'job-order-duplicate-receipt',
                'job-order-triplicate-receipt',
                'job-order-used-parts',
                //work load management
                'mf-work-order',
                'supervisor-approval',
                'print-work-order',
                // 'report-listing',
            //billing and accounting
                //Genera Ledger
                'billing-chart-accounts',
                //accounts payable
                'supplier',
                'check-voucher',
                //accounts receivable
                'jo-acknowledgement-receipt',
                'service-invoice',
                'receipts-payments',
                'counter-receipts',
                'payment-logs',
                'payment-report',
            //misc
                //work load settings
                'general-procedure',
                'process-group',
                'process-sub-group',
                'specification',
                'scope',
                'scope-description',
                'sub-group',
                'sub-group-rate',
                'work-sub-type',
                'work-status',
                //engine settings
                'cylinder-list',
                'category-list',
                'engine-category',
                'engine-model',
                'egine-parts',
                'machine-list',
                'make-list',
                'unit-model',
                'unit-model-list',
                'valve',
                //crm settings
                'client-type',
                'csa-type',
                'contact-person',
                //billing settings
                'billing-account-type',
                'billing-chart-accounts',
                'billing-invoice-type',
                'incentive-type',
                'billing-transaction-types',
                'type-of-payment',
                'receipt-for',
                'for',
                'receipt-type',
                'bank',
                'voucher-type',
                //auth settings
                'roles',
                'permissions',
                //other settings
                'branch',
                'discounts',
                'status',
                'holiday',
                 //Reports
                 'daily-reconciliation',
                 'operator-monthly-efficiency-report',
                 'weekly-revenue-by-category-csa',
                 'monthly-complience-report',
                 'weekly_revenue_generated_with_deductions',
                 'daily-operator',
                 'weekly-revenue-csa',
                 'monthly-industry-customer-report',
                 'revenue-generated-by-invoice-type',
                 //assets
                 'asset',
                 'machine-description',
                 'assign-machine-sub-groups',
                 'machine-category',
                 'machine-group',
                 'machine-group',
                 'machine-sub-group',
                 'machine-brand-name',
                 'machine-model-name',
                 'machine-condition-acquired-name',
                 'machine-cost-centers',
                 'machine-country-made',
                 'machine-depreciation',
                 'machine-plant-assigned',
                 'machine-purchase-from',
                 'machine-purchase-type',
                 'machine-statuses',
                 'machine-units',
            ],
            'Teller' => [

            ],
            'Clerk' => [

            ],
            'Accountant' => [
                'dashboard',
            //billing and accounting
                //accounts payable
                'service-billing',
                //accounts receivable
                'service-invoice',
                'receipt-type',
            //misc
                //billing settings
                'billing-account-type',
                'billing-chart-accounts',
                'billing-invoice-type',
                'incentive-type',
                'billing-transaction-types',
                'type-of-payment',
                'receipt-for',
                'document-type',
                'bank',
            ],
            'Supervisor' => [
                'dashboard',
                //inventory
                    'request-tools-supplies',
                    'inventory-report-listing',                   
                    'report-listing',
                //jom
                'approved-jo-order',
                //work load management
                'mf-work-order',
                'supervisor-approval',
                'print-work-order',      

            ],
            'Operator' => [
                'dashboard',
                 //jom
                //  'job-order',
                 //work load management
                // 'mf-work-order',
                // 'supervisor-approval',
                'print-work-order',
                 //inventory
                // 'stock-management',
                // 'procurement-management',
                // 'supplier-record',
                // 'inventory-report-listing',                   
                // 'report-listing',              

            ],            
            'Encoder' => [
                'dashboard',
                //crm
                'client-contact',
                // 'client-report-listing',
                //ums
                'user-profile',
                // 'user-logs',
                //inventory
                'stock-management',
                'procurement-management',
                'supplier-record',
                'request-tools-supplies',
                'inventory-report-listing',
                'report-listing',
                'purchase-history',
                'procurement-management',
                // 'supplier-record',
                // 'inventory-report-listing',
                'request-tools-supplies',
                //jom
                'job-order',
                'job-order-incentives',
                'job-order-receipts',
                'job-order-incentive-scan',
                'job-order-original-receipt',
                'job-order-duplicate-receipt',
                'job-order-triplicate-receipt',
                'job-order-used-parts',
                //work load management
                'mf-work-order',
                // 'print-work-order',
                'report-listing',
                //billing and accounting
                //accounts receivable
                'jo-acknowledgement-receipt',
                'service-invoice',
                 //misc
                //work load settings
                'general-procedure',
                'process-group',
                'process-sub-group',
                'specification',
                'scope',
                'scope-description',
                'sub-group',
                'sub-group-rate',
                'work-sub-type',
                'work-status',
                //engine settings
                'cylinder-list',
                'category-list',
                'engine-category',
                'engine-model',
                'egine-parts',
                'machine-list',
                'make-list',
                'unit-model',
                'unit-model-list',
                'valve',
                //crm settings
                'client-type',
                'csa-type',
                'contact-person',
                //other settings
                'branch',
                'discounts',
                'status',
                //Reports
                'daily-reconciliation',

            ],
            'Salesman' => [
                'dashboard',
                'job-order',
                //crm
                'client-contact',
                //work load management
                'supervisor-approval',
            ]
          
        ];
    }
}
