<?php

namespace Database\Seeders;

use App\Models\MachineConditionAquired;
use App\Models\MachineCountryMade;
use App\Models\MachineDepreciation;
use App\Models\MachineDeptLocation;
use App\Models\MachineUnit;
use App\Models\TbUnits;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PercentsSeeder::class,
            MakeListSeeder::class,
            CylinderListSeeder::class, 
            ValveSeeder::class,
            JobTypeSeeder::class,
            MachineListSeeder::class,
            ProcessGroupSeeder::class,
            ProcessSubGroupSeeder::class,
            SubGroupSeeder::class,
            SubGroupRatesSeeder::class,
            ScopeDescriptionSeeder::class,
            YearMadeSeeder::class,
            BranchSeeder::class,
            CsaTypeSeeder::class,
            StatusesSeeder::class,
            TypeOfPaymentsSeeder::class,
            TypeSeeder::class,
            CategoryListSeeder::class,
            CalibWorkGroupSeeder::class,
            WorkSubTypeSeeder::class,
            GeneralProcedureSeeder::class,
            DiscountTypeSeeder::class,
            IncentiveTypeSeeder::class,
            ErUnitSeeder::class,
            ERWorkGroupSeeder::class,
            ERScopeSeeder::class,
            UserSeeder::class, 
            PermissionsSeeder::class,
            RolesSeeder::class,
            EngineModelSeeder::class,
            InventoryTypeSeeder::class,
            UnitTypeSeeder::class,
            ChartOfAccountsSeeder::class,
            ForSeeder::class,
            ReceiptForSeeder::class,
            ReceiptTypeSeeder::class,
            TransactionStatusSeeder::class,
            LoanConsumeStatusSeeder::class,
            IndustrySeeder::class,
            ClientTypeSeeder::class,
            DepartmentSeeder::class,
            WorkAreaSeeder::class,
            TransactionTypesSeeder::class,
            InvoiceTypeSeeder::class,
            BankSeeder::class,
            SubsidiarySeeder::class,
            InvoiceIssuedSeeder::class,
            DiscountPercentageSeeder::class,
            PaymentTypeSeeder::class,
            DeleteReasonSeeder::class,
            MachineCategorySeeder::class,
            MachineIdNumberSeeder::class,
            MachineGroupSeeder::class,
            MachineSubGroupNameSeeder::class,
            AssignMechanicSubGroupSeeder::class,
            MachineDescriptionNumberId::class,
            MachineModelNameSeeder::class,
            MachinePlantAssignedSeeder::class,
            MachineDeptLocationSeeder::class,
            MachineCostCenterSeeder::class,
            MachineStatusSeeder::class,
            MachinePurchaseFromSeeder::class,
            MachinePurchaseTypeSeeder::class,
            MachineCountryMadeSeeder::class,
            MachineConditionAquiredSeeder::class,
            MachineDepreciationSeeder::class,
            MachineUnitSeeder::class,
            MachineBrandNameSeeder::class,
            UpdateMachineListSeeder::class,


            CollectSeeder::class,
            VoucherTypeSeeder::class,
            RemarkSeeder::class,
            ActivityLogTypeSeeder::class,
        ]);
    }
}
