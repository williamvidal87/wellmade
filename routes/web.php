<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\client\ClientTypeTable;
use App\Http\Livewire\client\CsaTypeTable;
use App\Http\Livewire\client\BranchTable;
use App\Http\Livewire\Auth\RolesTable;
use App\Http\Livewire\Auth\PermissionTable;
use App\Http\Livewire\UserLog\UserActivityLogTable;
use App\Http\Livewire\CRM\ClientReportListingTable;


//engine
use App\Http\Livewire\Engine\EngineCategoryTable;
use App\Http\Livewire\Engine\EngineModelTable;
use App\Http\Livewire\Engine\MakeListTable;
use App\Http\Livewire\Engine\CylinderListTable;
use App\Http\Livewire\Engine\CategoryListTable;
use App\Http\Livewire\Engine\UnitModelTable;
use App\Http\Livewire\Engine\UnitModelListTable;
use App\Http\Livewire\Engine\ValveTable;

//workload
use App\Http\Livewire\Workload\WorkStatusTable;
use App\Http\Livewire\Workload\MfWorkGroups;
use App\Http\Livewire\Workload\ErWorkGroupTable;
use App\Http\Livewire\Workload\SubTypeTable;
use App\Http\Livewire\Workload\WorkSubTypeTable;
use App\Http\Livewire\Workload\SubGroupTable;
use App\Http\Livewire\Workload\GeneralProcedureTable;
use App\Http\Livewire\Workload\ProcessGroupTable;
use App\Http\Livewire\Workload\IncentiveTypeTable;
use App\Http\Livewire\Workload\SubGroupRateTable;
//workorder
use App\Http\Livewire\Workorder\MfWorkOrderTable;
use App\Http\Livewire\Workorder\CalibrationWorkOrderTable;
use App\Http\Livewire\Workorder\ErWorkOrderTable;
use App\Http\Livewire\Workorder\JobReportListingTable;
use App\Http\Livewire\Engine\CalibWorkGroupTable;
use App\Http\Livewire\CRM\ClientContactTable;
use App\Http\Livewire\Inventory\ProcurementManagementTable;
use App\Http\Livewire\Inventory\StockManagementTable;
use App\Http\Livewire\Inventory\InventoryReportListingTable;
use App\Http\Livewire\Inventory\SupplierRecordTable;
use App\Http\Livewire\Machine\MachineTable;
use App\Http\Livewire\Machine\MachineandFabricationList;
use App\Http\Livewire\Machine\CalibrationTable;
use App\Http\Livewire\Workload\ScopeTable;
use App\Http\Livewire\Workload\SpecificationTable;
use App\Http\Livewire\Engine\EnginePartList;
use App\Http\Livewire\Engine\EngineReconditioningListTable;
use App\Http\Livewire\ComponentsParts\ComponentPartsList;
use App\Http\Livewire\Workorder\SupervisorApprovalTable;

//Dashboard
use App\Http\Livewire\DashBoard\DashBoard;

// JOMS
use App\Http\Livewire\JOMS\JobOrderTable;
// use App\Http\Livewire\JOMS\JOTable;
use App\Http\Livewire\JOMS\JOTypeTable;
use App\Http\Livewire\JOMS\JobOrderLogs;

//Print Work Order
use App\Http\Livewire\PrintWorkOrder\WorkOrderPrint;

//asset
use App\Http\Livewire\Asset\AssetTable;
use App\Http\Livewire\Asset\AssignMachineSubGroupTable;
use App\Http\Livewire\Asset\MachineCategoryTable;
use App\Http\Livewire\Asset\MachineGroupTable;
use App\Http\Livewire\Asset\MachineIdNumberTable;
use App\Http\Livewire\Asset\MachineSubGroupTable;
use App\Http\Livewire\Asset\MachineBrandNameTable;
use App\Http\Livewire\Asset\MachineModelNamesTable;
use App\Http\Livewire\Asset\MachineConditionAquiredTable;
use App\Http\Livewire\Asset\MachineCostCentersTable;
use App\Http\Livewire\Asset\MachineCountryMadeTable;
use App\Http\Livewire\Asset\MachineDepreciationTable;
use App\Http\Livewire\Asset\MachineDescriptionTable;
use App\Http\Livewire\Asset\MachinePlantAssignedTable;
use App\Http\Livewire\Asset\MachinePurchaseFromTable;
use App\Http\Livewire\Asset\MachinePurchaseTypeTable;
use App\Http\Livewire\Asset\MachineStatusesTable;
use App\Http\Livewire\Asset\MachineUnitsTable; 

//others
use App\Http\Livewire\Others\StatusTable;
use App\Http\Livewire\Others\TypeOfPaymentTable;
use App\Http\Livewire\Others\DiscountTable;
//billing
use App\Http\Livewire\Billing\AccountTypesTable;
use App\Http\Livewire\Billing\BankTable;
use App\Http\Livewire\Billing\ChartAccountsTable;
use App\Http\Livewire\Billing\CheckVoucherTable;
use App\Http\Livewire\Billing\CounterReceiptTable;
use App\Http\Livewire\Billing\ForTable;
use App\Http\Livewire\Billing\InvoiceTypeTable;
use App\Http\Livewire\Billing\JoAcknowledgementReceiptTable;
use App\Http\Livewire\Billing\PaymentLogTable;
use App\Http\Livewire\Billing\PaymentReportsTable;
use App\Http\Livewire\Billing\ReceiptForTable;
use App\Http\Livewire\Billing\ReceiptsPaymentsTable;
use App\Http\Livewire\Billing\ReceiptTypeTable;
use App\Http\Livewire\Billing\ServiceBillingTable;
use App\Http\Livewire\Billing\ServiceInvoiceTable;
use App\Http\Livewire\Billing\SupplierTable;
use App\Http\Livewire\Billing\TransactionTypesTable;
use App\Http\Livewire\Billing\VoucherTypeTable;
use App\Http\Livewire\CRM\ContactLogTable;
use App\Http\Livewire\CRM\ContactTable;
use App\Http\Livewire\Inventory\DailyMaintenanceReportTable;
use App\Http\Livewire\Inventory\DailyShopSuppliesReportTable;
use App\Http\Livewire\Inventory\PurchaseHistoryTable;
use App\Http\Livewire\Inventory\RequestToolsSuppliesTable;
use App\Http\Livewire\JOMS\ApprovedJO;
use App\Http\Livewire\JOMS\JobOrderDublicateTable;
use App\Http\Livewire\JOMS\JobOrderIncentivesTable;
use App\Http\Livewire\JOMS\JobOrderOriginalReportTable;
use App\Http\Livewire\JOMS\JobOrderTriplicateTable;
use App\Http\Livewire\JOMS\JoUsedPartTable;
use App\Http\Livewire\Others\HolidayTable;
use App\Http\Livewire\JOMS\ScanIncentive;
use App\Http\Livewire\Report\DailyOperatorTable;
use App\Http\Livewire\Report\WeeklyRevenueCsaTable;
use App\Http\Livewire\Report\MonthlyComplienceReportTable;
use App\Http\Livewire\Report\MonthlyNewCustomerPerformanceReportTable;
use App\Http\Livewire\Report\OperatorMonthlyEfficiencyReportTable;
use App\Http\Livewire\Report\ReconciliationTable;
use App\Http\Livewire\Report\RevenueGeneratedInvoiceTypeTable;
use App\Http\Livewire\Report\WeeklyRevenueByCategoryCsaTable;
use App\Http\Livewire\Report\WeeklyRevenueGeneratedWithDeductionTable;
use App\Http\Livewire\UMS\UserProfileTable;
use App\Http\Livewire\UMS\UserReportListingTable;
use App\Http\Livewire\Workload\ProcessSubGroupTable;
use App\Http\Livewire\Workload\ScopeDescriptionTable;


// use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/haha', function () {   
    // return view('welcome');   
    return redirect()->route('login');
});
Route::get('/', function () {   
    // return view('welcome');   
    return redirect()->route('login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
    'useraccess',
]], function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    //Users
    Route::get('/user-profile', UserProfileTable::class)->name('user-profile');   
    Route::get('user-report-listing', UserReportListingTable::class)->name('user-report-listing');
    
    

    //Miscellaneous
    Route::get('/client-type', ClientTypeTable::class)->name('client-type');
    Route::get('/csa-type', CsaTypeTable::class)->name('csa-type');
    Route::get('/branch', BranchTable::class)->name('branch');
    Route::get('/client-report-listing', ClientReportListingTable::class)->name('client-report-listing');
    Route::get('/contact-person', ContactTable::class)->name('contact-person');
    Route::get('/holiday', HolidayTable::class)->name('holiday');
   
    //workload
    Route::get('/work-status', WorkStatusTable::class)->name('work-status');
    Route::get('/engine-model', EngineModelTable::class)->name('engine-model');
    Route::get('/engine-category', EngineCategoryTable::class)->name('engine-category');

    //billing
    Route::get('/check-voucher', CheckVoucherTable::class)->name('check-voucher');
    Route::get('/voucher-type', VoucherTypeTable::class)->name('voucher-type');
    Route::get('/billing-account-type', AccountTypesTable::class)->name('billing-account-type');
    Route::get('/billing-invoice-type', InvoiceTypeTable::class)->name('billing-invoice-type');
    Route::get('/receipt-type', ReceiptTypeTable::class)->name('receipt-type');
    Route::get('/billing-transaction-types', TransactionTypesTable::class)->name('billing-transaction-types');
    Route::get('/billing-chart-accounts', ChartAccountsTable::class)->name('billing-chart-accounts');
    Route::get('/service-billing', ServiceBillingTable::class)->name('service-billing');
    Route::get('/service-invoice', ServiceInvoiceTable::class)->name('service-invoice');
    Route::get('/receipt-for', ReceiptForTable::class)->name('receipt-for');
    Route::get('/for', ForTable::class)->name('for');
    Route::get('/bank', BankTable::class)->name('bank');
    Route::get('/receipts-payments', ReceiptsPaymentsTable::class)->name('receipts-payments');
    Route::get('/jo-acknowledgement-receipt', JoAcknowledgementReceiptTable::class)->name('jo-acknowledgement-receipt');
    Route::get('/counter-receipts', CounterReceiptTable::class)->name('counter-receipts');
    Route::get('/supplier', SupplierTable::class)->name('supplier');
    //workload end
    Route::get('/mf-work-group', MfWorkGroups::class)->name('mf-work-group');
    Route::get('/er-work-group', ErWorkGroupTable::class)->name('er-work-group');
    Route::get('/sub-type', SubTypeTable::class)->name('sub-type');
    Route::get('/work-sub-type', WorkSubTypeTable::class)->name('work-sub-type');
    Route::get('/general-procedure', GeneralProcedureTable::class)->name('general-procedure');
    Route::get('/process-group', ProcessGroupTable::class)->name('process-group');
    Route::get('/process-sub-group', ProcessSubGroupTable::class)->name('process-sub-group');
    Route::get('/sub-group', SubGroupTable::class)->name('sub-group');
    Route::get('/incentive-type', IncentiveTypeTable::class)->name('incentive-type');
    Route::get('/sub-group-rate', SubGroupRateTable::class)->name('sub-group-rate');
    Route::get('/scope-description', ScopeDescriptionTable::class)->name('scope-description');
    
    //workOrder
    Route::get('/mf-work-order', MfWorkOrderTable::class)->name('mf-work-order');
    Route::get('/calibration-work-order', CalibrationWorkOrderTable::class)->name('calibration-work-order');
    Route::get('/er-work-order', ErWorkOrderTable::class)->name('er-work-order');
    Route::get('/report-listing', JobReportListingTable::class)->name('report-listing');  
    Route::get('/supervisor-approval', SupervisorApprovalTable::class)->name('supervisor-approval');

    //engine
    Route::get('/calib-work-group', CalibWorkGroupTable::class)->name('calib-work-group');
    Route::get('/machine-list', MachineTable::class)->name('machine-list');
    Route::get('/scope', ScopeTable::class)->name('scope');
    Route::get('/engine-reconditioning-list', EngineReconditioningListTable::class)->name('engine-reconditioning-list');
    Route::get('/calibration-list', CalibrationTable::class)->name('calibration-list');
    Route::get('/specification', SpecificationTable::class)->name('specification');
    Route::get('/machine-and-fabrication-list', MachineandFabricationList::class)->name('machine-and-fabrication-list');
    Route::get('/engine-parts', EnginePartList::class)->name('engine-parts');
    Route::get('/component-parts', ComponentPartsList::class)->name('component-parts');
    Route::get('/make-list', MakeListTable::class)->name('make-list');
    Route::get('/cylinder-list', CylinderListTable::class)->name('cylinder-list');
    Route::get('/category-list', CategoryListTable::class)->name('category-list');
    Route::get('/unit-model', UnitModelTable::class)->name('unit-model');    
    Route::get('/unit-model-list', UnitModelListTable::class)->name('unit-model-list');
    Route::get('/valve', ValveTable::class)->name('valve');
    //others
    Route::get('/status', StatusTable::class)->name('status');
    Route::get('/type-of-payment', TypeOfPaymentTable::class)->name('type-of-payment');
    Route::get('/discount', DiscountTable::class)->name('discount');

    Route::get('/client-contact', ClientContactTable::class)->name('client-contact');   

    //DashBoard
    Route::get('/dashboard', DashBoard::class)->name('dashboard'); //change from dash-board 

    //JOMS
    Route::get('/job-order', JobOrderTable::class)->name('job-order');
    Route::get('/j-otype', JOTypeTable::class)->name('j-otype');
    Route::get('/job-order-logs', JobOrderLogs::class)->name('job-order-logs');
    Route::get('/approved-jo-order', ApprovedJO::class)->name('approved-jo-order');
    Route::get('/job-order-original-receipt', JobOrderOriginalReportTable::class)->name('job-order-original-receipt');
    Route::get('/job-order-receipts', JobOrderOriginalReportTable::class)->name('job-order-receipts');
    Route::get('/job-order-incentive-scan', ScanIncentive::class)->name('job-order-incentive-scan');
    Route::get('/job-order-incentives', JobOrderIncentivesTable::class)->name('job-order-incentives');
    Route::get('/job-order-used-parts', JoUsedPartTable::class)->name('job-order-used-parts');

    //Print Work Order
    Route::get('/print-work-order', WorkOrderPrint::class)->name('print-work-order');
    //Auth
    Route::get('/roles', RolesTable::class)->name('roles');
    Route::get('/permissions', PermissionTable::class)->name('permissions');
    //Activity log
    Route::get('/user-logs', UserActivityLogTable::class)->name('user-logs');
    Route::get('/payment-logs', PaymentLogTable::class)->name('payment-logs');
    Route::get('/contact-incentives-logs', ContactLogTable::class)->name('contact-incentives-logs');

    // Inventory
    Route::get('/supplier-record', SupplierRecordTable::class)->name('supplier-record');
    Route::get('/stock-management', StockManagementTable::class)->name('stock-management');
    Route::get('/procurement-management', ProcurementManagementTable::class)->name('procurement-management');
    Route::get('inventory-report-listing', InventoryReportListingTable::class)->name('inventory-report-listing');
    Route::get('/purchase-history', PurchaseHistoryTable::class)->name('purchase-history');
    Route::get('/request-tools-supplies', RequestToolsSuppliesTable::class)->name('request-tools-supplies');
    Route::get('daily-shop-supplies-report', DailyShopSuppliesReportTable::class)->name('daily-shop-supplies-report');
    Route::get('daily-maintenance-report', DailyMaintenanceReportTable::class)->name('daily-maintenance-report');

    //asset
    Route::get('/asset', AssetTable::class)->name('asset');
    Route::get('/machine-description', MachineDescriptionTable::class)->name('machine-description');
    Route::get('/assign-machine-sub-groups', AssignMachineSubGroupTable::class)->name('assign-machine-sub-groups');
    Route::get('/machine-category', MachineCategoryTable::class)->name('machine-category');
    Route::get('/machine-group', MachineGroupTable::class)->name('machine-group');
    Route::get('/machine-number', MachineIdNumberTable::class)->name('machine-number');
    Route::get('/machine-sub-group', MachineSubGroupTable::class)->name('machine-sub-group');
    Route::get('/machine-brand-name', MachineBrandNameTable::class)->name('machine-brand-name');
    Route::get('/machine-model-name', MachineModelNamesTable::class)->name('machine-model-name');
    Route::get('/machine-condition-acquired-name', MachineConditionAquiredTable::class)->name('machine-condition-acquired-name');
    Route::get('/machine-cost-centers', MachineCostCentersTable::class)->name('machine-cost-centers');
    Route::get('/machine-country-made', MachineCountryMadeTable::class)->name('machine-country-made');
    Route::get('/machine-depreciation', MachineDepreciationTable::class)->name('machine-depreciation');
    Route::get('/machine-plant-assigned', MachinePlantAssignedTable::class)->name('machine-plant-assigned');
    Route::get('/machine-purchase-from', MachinePurchaseFromTable::class)->name('machine-purchase-from');
    Route::get('/machine-purchase-type', MachinePurchaseTypeTable::class)->name('machine-purchase-type');
    Route::get('/machine-statuses', MachineStatusesTable::class)->name('machine-statuses');
    Route::get('/machine-units', MachineUnitsTable::class)->name('machine-units');
    //Reports
    Route::get('payment-report', PaymentReportsTable::class)->name('payment-report');
    Route::get('daily-reconciliation', ReconciliationTable::class)->name('daily-reconciliation');
    Route::get('daily-operator', DailyOperatorTable::class)->name('daily-operator');
    Route::get('weekly-revenue-csa', WeeklyRevenueCsaTable::class)->name('weekly-revenue-csa');
    Route::get('operator-monthly-efficiency-report', OperatorMonthlyEfficiencyReportTable::class)->name('operator-monthly-efficiency-report');
    Route::get('weekly-revenue-by-category-csa', WeeklyRevenueByCategoryCsaTable::class)->name('weekly-revenue-by-category-csa');
    Route::get('monthly-complience-report', MonthlyComplienceReportTable::class)->name('monthly-complience-report');
    Route::get('weekly_revenue_generated_with_deductions', WeeklyRevenueGeneratedWithDeductionTable::class)->name('weekly_revenue_generated_with_deductions');
    Route::get('monthly-industry-customer-report', MonthlyNewCustomerPerformanceReportTable::class)->name('monthly-industry-customer-report');
    Route::get('revenue-generated-by-invoice-type', RevenueGeneratedInvoiceTypeTable::class)->name('revenue-generated-by-invoice-type');
});