<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">


        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================
            <div class="mainnav-brand">
                <a href="index.html" class="brand">
                    <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                    <span class="brand-text">Nifty</span>
                </a>
                <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
            </div>
            -->



        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md mx-auto d-block" src="img/profile-photos/1.png"
                                    alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name">{{ auth()->user()->name }}</p>
                                <span class="mnp-desc">{{ auth()->user()->email }}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')"
                                class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                            </a>
                            <!-- <a href="#" class="list-group-item">
                                    <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                </a> -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf  
                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();"><i
                                        class="demo-pli-unlock icon-lg icon-fw"></i>Logout
                                </x-jet-dropdown-link>
                            </form>
                        </div>
                    </div>


                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                        <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                        <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                        <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{ route('user-profile') }}">User Profile</a></li>
                                    <li><a href="">User Logs</a></li>
                                    <li><a href="">Users Incentives Log</a></li>
                                    <li><a href="">User Reports Listing</a></li>
                                </ul>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{ route('stock-management') }}">Stock Management</a></li>
                                    <li><a href="{{ route('procurement-management') }}">Procurement Management</a></li>
                                    <li><a href="{{ route('supplier-record') }}">Supplier Record Management</a></li>
                                    {{-- <li><a href="">Inventory Reports Listing</a></li> --}}
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        <li class="list-header">Navigation</li>

                        <!--Menu list item-->
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fa fa-home"></i>
                                <span class="menu-title">Dashboard</span></i>
                            </a>
                        </li>



                        <li class="list-divider"></li>

                        <!--Category name-->
                        <li class="list-header">Pages</li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-address-book"></i>
                                <span class="menu-title">CRM</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{ route('client-contact') }}">Client and Contact Profile</a></li>
                                <li><a href="{{ route('contact-incentives-logs') }}">Contact Incentives Log</a></li>                               
                                <li><a href="{{ route('client-report-listing')}}">Client Report Listing</a></li>
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-id-badge"></i>
                                <span class="menu-title">User Management</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('user-profile')}}">User Profile</a></li>
                                <li><a href="{{route('user-logs')}}">User Logs</a></li>
                                <li><a href="">Users Incentives Log</a></li>
                                <li><a href=" {{ route('user-report-listing')}}">User Reports Listing</a></li>
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-list-ul"></i>
                                <span class="menu-title">Inventory</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{ route('stock-management') }}">Stock Management</a></li>
                                <li><a href="{{route('procurement-management')}}">Procurement Management</a></li>
                                <li><a href="{{ route('supplier-record') }}">Supplier Record Management</a></li>
                                <li><a href="{{ route('request-tools-supplies') }}">Request Tools/Supplies</a></li>
                                <li><a href="{{ route('purchase-history') }}">Purchase History</a></li> 
                                <li><a href="{{ route('job-order-used-parts') }}">Used Parts</a></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-files-o" aria-hidden="true"></i>
                                        <span class="menu-title"> Inventory Reports</span>
                                        <i class="arrow"></i>
                                    </a>
        
                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="{{ route('report-listing')}}">Daily Consumable Report</a></li>   
                                        <li><a href="{{ route('daily-shop-supplies-report')}}">Daily Shop Supplies Report</a></li>  
                                        <li><a href="{{ route('daily-maintenance-report')}}">Daily Maintenance Report</a></li>   
                                        {{-- <li><a href="{{ route('inventory-report-listing')}}">Stocks Management Reports</a></li>     --}}
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <span class="menu-title">Job Order Management</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{ route('job-order') }}">Job Order</a></li>
                                {{-- <li><a href="#">Job Order Logs</a></li> --}}
                                <li><a href="{{ route('approved-jo-order') }}">Finished Job Order</a></li>
                                <li><a href="{{ route('job-order-incentives') }}">Incentives</a></li>
                                <li><a href="{{ route('job-order-incentive-scan') }}">Scan Incentives</a></li>
                                <li><a href="{{ route('job-order-receipts') }}">Receipts</a></li>
                                {{-- <li>
                                    <a href="#">
                                        <span class="menu-title">Job Order Receipts</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="{{ route('job-order-original-receipt') }}">Original</a></li>
                                        <li><a href="{{ route('job-order-duplicate-receipt') }}">Duplicate</a></li>
                                        <li><a href="{{ route('job-order-triplicate-receipt') }}">Triplicate</a></li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <span class="menu-title">Work Load Management</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{ route('mf-work-order')}}">Work Order </a></li>
                                <li><a href="{{ route('supervisor-approval')}}">Supervisor's Approval</a></li>
                                {{-- <li><a href="{{ route('report-listing')}}">Work Order Report Listing</a></li> --}}
                            </ul>
                        </li>

                        <a href="{{ route('print-work-order')}}">
                            <i class="fa fa-barcode" aria-hidden="true"></i>
                            <span class="menu-title">Scan Work Order</span>
                            <i class="arrow"></i>
                        </a>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <span class="menu-title">Billing and Accounting</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">General Ledger</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="{{ route('billing-chart-accounts') }}">Chart Of Accounts</a></li>
                                        {{-- <li><a href="">Financial Statements</a></li>
                                        <li><a href="">Journal Vouchers</a></li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-credit-card"></i>
                                        <span class="menu-title">Accounts Payable</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="{{ route('supplier') }}">Suppliers</a></li>
                                        {{-- <li><a href="">Parts/Exp. Items</a></li>
                                        <li><a href="">Supplier Invoice</a></li> --}}
                                        <li><a href="{{ route('check-voucher') }}">Check Vouchers</a></li>
                                        {{-- <li><a href="{{ route('service-billing') }}">Accounts Payable</a></li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-money"></i>
                                        <span class="menu-title">Accounts Receivable</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        {{-- <li><a href="">Customers</a></li>
                                        <li><a href="">Customer Reps</a></li>
                                        <li><a href="">Job/Services</a></li> --}}
                                        <li><a href="{{ route('jo-acknowledgement-receipt') }}">JO Acknowledgement Receipts</a></li>
                                        <li><a href="{{ route('service-invoice') }}">Service Invoices</a></li>
                                        {{-- <li><a href="">Parts Invoices</a></li>
                                        <li><a href="">Counter Receipts</a></li> --}}
                                        <li><a href="{{ route('receipts-payments') }}">Receipts/Payments</a></li>
                                        <li><a href="{{ route('counter-receipts') }}">Counter Receipts</a></li>
                                    </ul>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('check-voucher') }}">
                                        <span class="menu-title">Check Vouchers</span></i>
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('payment-logs') }}">
                                        <span class="menu-title">Payments Logs</span></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('payment-report') }}">
                                        <span class="menu-title">Payments Reports</span></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="menu-title">Miscellaneous</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="list-header"> Settings</li>
                                <li class="list-header">Work Load Settings</li>
                                <li><a href="{{ route('general-procedure') }}">General Procedure </a></li>
                                <li><a href="{{ route('process-group') }}">Process Group </a></li>
                                <li><a href="{{ route('process-sub-group') }}">Process Sub Group</a></li>
                                <li><a href="{{route('specification')}}">Specification</a></li>
                                <li><a href="{{ route('scope') }}">ER Scope</a></li>
                                <li><a href="{{ route('scope-description') }}">Scope Description</a></li>
                                <li><a href="{{ route('sub-group') }}">Work Group</a></li>
                                <li><a href="{{ route('sub-group-rate') }}">Work Sub-Group and Rates</a></li>
                                <li><a href="{{ route('work-sub-type') }}">Work Sub Type</a></li>
                                <li><a href="{{ route('work-status') }}">Work Status </a></li>
                                <li class="list-header">Engine Settings</li>
                                <li><a href="{{route('cylinder-list')}}">Cylinder List</a></li>
                                <li><a href="{{route('category-list')}}">Category List</a></li>
                                <li><a href="{{ route('engine-category') }}">Engine Category </a></li>
                                <li><a href="{{ route('engine-model') }}">Engine Model </a></li>
                                <li><a href="{{route('engine-parts')}}">Engine Part</a></li>
                                <li><a href="{{ route('machine-list') }}">Machine List </a></li>
                                <li><a href="{{route('make-list')}}">Make List</a></li>
                                <li><a href="{{route('unit-model')}}">Unit Model</a></li>
                                <li><a href="{{route('unit-model-list')}}">Unit Model List</a></li>
                                <li><a href="{{route('valve')}}">Valve</a></li>
                                <li class="list-header">CRM Settings</li>
                                <li><a href="{{ route('client-type') }}">Client Type </a></li>
                                <li><a href="{{ route('csa-type') }}">Csa Type</a></li>
                                <li><a href="{{ route('contact-person') }}">Contact Person</a></li>
                                <li class="list-header">Billing Settings</li>
                                <li><a href="{{ route('billing-account-type') }}">Account Types </a></li>
                                <li><a href="{{ route('billing-chart-accounts') }}">Chart of Accounts </a></li>
                                <li><a href="{{ route('billing-invoice-type') }}">Invoice Type </a></li>
                                <li><a href="{{ route('incentive-type') }}">Incentive Type</a></li>
                                <li><a href="{{ route('billing-transaction-types') }}">Transaction Types </a></li>
                                <li><a href="{{ route('type-of-payment') }}">Type of Payments </a></li>
                                <li><a href="{{ route('receipt-for') }}">Receipt For </a></li>
                                <li><a href="{{ route('for') }}">For </a></li>
                                <li><a href="{{ route('receipt-type') }}">Receipt Type </a></li>
                                <li><a href="{{ route('bank') }}">Bank </a></li>
                                <li class="list-header">Asset Settings</li>
                                <li><a href="{{ route('asset') }}">Asset</a></li>
                                <li><a href="{{ route('machine-description') }}">Machine Description</a></li>
                                <li><a href="{{ route('assign-machine-sub-groups')}}">Assign Machine Sub Groups</a></li>
                                <li><a href="{{ route('machine-category')}}">Machine Category</a></li>
                                <li><a href="{{ route('machine-group')}}">Machine Group</a></li>
                                <li><a href="{{ route('machine-number')}}">Machine Number</a></li>
                                <li><a href="{{ route('machine-sub-group')}}">Machine Sub Group</a></li>
                                <li><a href="{{ route('machine-brand-name')}}">Machine Brand Name</a></li>
                                <li><a href="{{ route('machine-model-name')}}">Machine Model Name</a></li>
                                <li><a href="{{ route('machine-condition-acquired-name')}}">Machine Condition Acquired Name</a></li>
                                <li><a href="{{ route('machine-cost-centers')}}">Machine Cost Centers</a></li>
                                <li><a href="{{ route('machine-country-made')}}">Machine Country Made</a></li>
                                <li><a href="{{ route('machine-depreciation')}}">Machine Depreciation</a></li>
                                <li><a href="{{ route('machine-plant-assigned')}}">Machine Plant Assigned</a></li>
                                <li><a href="{{ route('machine-purchase-from')}}">Machine Purchase From</a></li>
                                <li><a href="{{ route('machine-purchase-type')}}">Machine Purchase Types</a></li>
                                <li><a href="{{ route('machine-statuses')}}">Machine Statuses</a></li>
                                <li><a href="{{ route('machine-units')}}">Machine Units</a></li>

                                <li><a href="{{ route('voucher-type') }}">Voucher Type </a></li>
                                <li class="list-header">Authentication Settings</li>
                                <li><a href="{{ route('roles') }}">Roles </a></li>
                                <li><a href="{{ route('permissions') }}">Permission </a></li>
                                <li class="list-header">Others Settings</li>
                                <li><a href="{{ route('branch') }}">Branch</a></li>
                                <li><a href="{{ route('discount') }}">Discounts </a></li>
                                <li><a href="{{ route('status') }}">Statuses </a></li>
                                <li><a href="{{ route('holiday') }}">Holiday</a></li>
                                
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="fa fa-files-o" aria-hidden="true"></i>
                                <span class="menu-title">Reports</span></i>
                            </a>
                            <ul>
                                 <li><a href="{{ route('daily-reconciliation')}}">Daily Reconciliation Report</a></li>
                                 <li><a href="{{ route('operator-monthly-efficiency-report')}}">Monthly Operator Efficiency Report</a></li>         
                                 <li><a href="{{ route('weekly-revenue-by-category-csa')}}">Weely Revenue by Category (CSA)</a></li> 
                                 <li><a href="{{ route('weekly_revenue_generated_with_deductions')}}">Weekly Revenue with Deductions</a></li>                                                         
                                 <li><a href="{{ route('monthly-complience-report')}}">Monthly Complience Report</a></li>
                                 <li><a href="{{ route('daily-operator')}}">Daily Operator Efficiency Report</a></li>
                                 <li><a href="{{ route('weekly-revenue-csa')}}">Weekly Revenue by CSA Report</a></li>                                                         
                                 <li><a href="{{ route('monthly-industry-customer-report')}}">Monthly Industry & New Customer Performance Report</a></li>                                                         
                                 <li><a href="{{ route('revenue-generated-by-invoice-type')}}">Revenue Generated by Invoice Type</a></li>                                                         
                            </ul>

                        </li>

                    </ul>

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
