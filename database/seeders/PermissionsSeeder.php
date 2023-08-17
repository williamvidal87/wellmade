<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [

				'name' 			=> 'can.access.crm',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.crm',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.crm',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.crm',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.crm',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.role',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.role',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.role',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.role',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.role',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.permission',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.permission',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.permission',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.permission',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.permission',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.crm_incentive',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.crm_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.crm_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.crm_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.crm_incentive',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.crm_report',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.crm_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.crm_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.crm_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.crm_report',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.user',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.user',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.user',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.user',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.user',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.user_logs',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.user_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.user_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.user_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.user_logs',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.user_incentive',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.user_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.user_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.user_incentive',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.user_incentive',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.user_rep',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.user_rep',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.user_rep',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.user_rep',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.user_rep',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.stock',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.stock',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.stock',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.stock',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.stock',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.procurement',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.procurement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.procurement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.procurement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.procurement',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.supplier',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.supplier',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.supplier',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.supplier',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.supplier',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.inv_logs',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.inv_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.inv_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.inv_logs',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.inv_logs',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.jo',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.jo',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.jo',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.jo',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.jo',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.mf_work_order',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.mf_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.mf_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.mf_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.mf_work_order',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.er_work_order',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.er_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.er_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.er_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.er_work_order',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.calib_work_order',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.calib_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.calib_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.calib_work_order',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.calib_work_order',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.workload_report',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.workload_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.workload_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.workload_report',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.workload_report',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.chart_of_account',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.chart_of_account',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.chart_of_account',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.chart_of_account',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.chart_of_account',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.financial_statement',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.financial_statement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.financial_statement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.financial_statement',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.financial_statement',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.journal_vouchers',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.journal_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.journal_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.journal_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.journal_vouchers',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.suppliers',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.suppliers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.suppliers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.suppliers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.suppliers',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.part_items',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.part_items',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.part_items',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.part_items',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.part_items',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.supplier_invoice',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.supplier_invoice',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.supplier_invoice',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.supplier_invoice',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.supplier_invoice',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.check_vouchers',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.check_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.check_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.check_vouchers',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.check_vouchers',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_customer',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_customer',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_customer',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_customer',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_customer',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_cus_reps',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_cus_reps',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_cus_reps',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_cus_reps',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_cus_reps',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_services',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_services',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_services',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_services',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_services',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_part_invoices',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_part_invoices',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_part_invoices',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_part_invoices',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_part_invoices',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_counter_receipts',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_counter_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_counter_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_counter_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_counter_receipts',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.ar_receipts',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.ar_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.ar_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.ar_receipts',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.ar_receipts',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.debts_record',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.debts_record',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.debts_record',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.debts_record',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.debts_record',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.payment_lose',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.payment_lose',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.payment_lose',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.payment_lose',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.payment_lose',
                'guard_name' 	=> 'web',
			],
			[

				'name' 			=> 'can.access.payment_reports',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'can.create.payment_reports',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.store.payment_reports',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.edit.payment_reports',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'can.delete.payment_reports',
                'guard_name' 	=> 'web',
			],
			
			
		];   
        
        // foreach ($permissions as $key => $value) {

        //     Permission::insert([
        //         'name' => $value['name'],
        //         'guard_name' => $value['guard_name'],
        //     ]);
		// }
    }
}
