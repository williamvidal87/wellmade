<?php

namespace Database\Seeders;

use App\Models\ChartOfAccounts;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [    
                'account_code' => '1100',
                'account_desc'  => 'PETTY CASH FUND'
            ],
            [    
                'account_code' => '1101',
                'account_desc'  => 'CASH ON HAND',
            ],
            [
                'account_code' => '1102',
                'account_desc'  => 'CASH IN BANK - BDO (SO)',
            ],
            [
                'account_code' => '1103',
                'account_desc'  => 'CASH IN BANK - MBTC',
            ],
            [
                'account_code' => '1115',
                'account_desc'  => 'CASH REVOLVING FUND',
            ],
            [
                'account_code' => '1200',
                'account_desc'  => 'ACCOUNTS RECEIVABLE - TRADE',
            ],
            [
                'account_code' => '1201',
                'account_desc'  => 'ACCOUNTS RECEIVABLE - (SSS)',
            ],
            [
                'account_code' => '1202',
                'account_desc'  => 'ACCOUNTS RECEIVABLE - EMPLOYEES',
            ],
            [
                'account_code' => '1203',
                'account_desc'  => 'ACCOUNTS RECEIVABLE - OTHERS',
            ],
            [
                'account_code' => '1205',
                'account_desc'  => 'ACCOUNTS RECEIVABLE - EMPLOYEES INSURANCE',
            ],
            [
                'account_code' => '1300',
                'account_desc'  => 'MERCHANDISE INVENTORY',
            ],
            [
                'account_code' => '1400',
                'account_desc'  => 'PREPAID EXPENSE',
            ],
            [
                'account_code' => '1500',
                'account_desc'  => 'TAX CREDITS - INCOME',
            ],
            [
                'account_code' => '1501',
                'account_desc'  => 'INPUT TAX',
            ],
            [
                'account_code' => '1503',
                'account_desc'  => 'TAX CREDITS - VAT',
            ],
            [
                'account_code' => '2000',
                'account_desc'  => 'OFFICE BUILDING',
            ],
            [
                'account_code' => '2100',
                'account_desc'  => 'MARCHINERIES AND EQUIPMENT',
            ],
            [
                'account_code' => '2101',
                'account_desc'  => 'FURNITURES AND FIXTURES',
            ],
            [
                'account_code' => '2102',
                'account_desc'  => 'OFFICE EQUIPMENT',
            ],
            [
                'account_code' => '2103',
                'account_desc'  => 'MEASURING INSTRUMENTS & TOOLINGS',
            ],
            [
                'account_code' => '2104',
                'account_desc'  => 'TRANSPORTATION EQUIPMENT',
            ],
            [
                'account_code' => '2105',
                'account_desc'  => 'UNAMORTIZED LEASEHOLD IMPROVEMENT',
            ],
            [
                'account_code' => '2200',
                'account_desc'  => 'ACCUM. DEPRECIATION - MACHINERIES & EQUIPMENT',
            ],
            [
                'account_code' => '2201',
                'account_desc'  => 'ACCUM. DEPRECIATION - FURNITURES & FIXTURES',
            ],
            [
                'account_code' => '2202',
                'account_desc'  => 'ACCUM. DEPRECIATION - OFFICE EQUIPMENT',
            ],
            [
                'account_code' => '2203',
                'account_desc'  => 'ACCUM. DEPRECIATION - MEASURING INS. & TOOLINGS',
            ],
            [
                'account_code' => '2204',
                'account_desc'  => 'ACCUM. DEPRECIATION - TRANSPORTATION EQUIPMENT',
            ],
            [
                'account_code' => '2300',
                'account_desc'  => 'INVESTMENTS',
            ],
            [
                'account_code' => '2400',
                'account_desc'  => 'PRE-OPERATING EXPENSES',
            ],
            [
                'account_code' => '2500',
                'account_desc'  => 'DEFERRED OUPUT TAX',
            ],
            [
                'account_code' => '2700',
                'account_desc'  => 'DEPOSITS FOR TRANSFORMERS',
            ],
            [
                'account_code' => '2701',
                'account_desc'  => 'DEPOSITS FOR NORECO II',
            ],
            [
                'account_code' => '2703',
                'account_desc'  => 'DEPOSITS FOR CUSTOMERS',
            ],
            [
                'account_code' => '3100.0',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (CALIBRATION PARTS)',
            ],
            [
                'account_code' => '3100.1',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (MACHINERIES/EQUPT.)',
            ],
            [
                'account_code' => '3100.2',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (MPMS)',
            ],
            [
                'account_code' => '3100.3',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (OFFICE EQUIPT.)',
            ],
            [
                'account_code' => '3100.4',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (OFFICE SUPPLIES)',
            ],
            [
                'account_code' => '3100.5',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (PARTS)',
            ],
            [
                'account_code' => '3100.7',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (R/M-BLDG.)',
            ],
            [
                'account_code' => '3100.8',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (R/M-MACHINERIES)',
            ],
            [
                'account_code' => '3100.9',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (R/M-OFFICE EQUIPT.)',
            ],
            [
                'account_code' => '3101.1',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (R/M-TRANSPORT. EQUIPT.)',
            ],
            [
                'account_code' => '3101.2',
                'account_desc'  => 'ACCOUNTS PAYABLE - TRADE (TRANSPORTATION EQUIPT.)',
            ],
            [
                'account_code' => '3200',
                'account_desc'  => 'ACCOUNTS PAYABLE OTHERS',
            ],
            [
                'account_code' => '3201',
                'account_desc'  => 'WITHHOLDING TAX PAYABLE-WAGES',
            ],
            [
                'account_code' => '3202',
                'account_desc'  => 'WITHHOLDING TAX PAYABLE-SOURCES',
            ],
            [
                'account_code' => '3203',
                'account_desc'  => 'SSS PREMIUM PAYABLE',
            ],
            [
                'account_code' => '3204',
                'account_desc'  => 'PHILHEALTH PREMIUM PAYABLE',
            ],
            [
                'account_code' => '3205',
                'account_desc'  => 'HDMF PREMIUM PAYABLE',
            ],
            [
                'account_code' => '3206',
                'account_desc'  => 'SSS LOAN PAYABLE',
            ],
            [
                'account_code' => '3207',
                'account_desc'  => 'HDMF LOAN PAYABLE',
            ],
            [
                'account_code' => '3209',
                'account_desc'  => 'INCOME TAX PAYABLE',
            ],
            [
                'account_code' => '3210',
                'account_desc'  => 'OUPUT TAX PAYABLE',
            ],
            [
                'account_code' => '3211',
                'account_desc'  => 'VAT PAYABLE',
            ],
            [
                'account_code' => '3300',
                'account_desc'  => 'ACCRUED EXPENSE PAYABLE',
            ],
            [
                'account_code' => '4100',
                'account_desc'  => 'ADVANCES FROM STOCKHOLDERS',
            ],
            [
                'account_code' => '4200',
                'account_desc'  => 'NOTES PAYABLE',
            ],
            [
                'account_code' => '5000',
                'account_desc'  => 'OTHER INCOME',
            ],
            [
                'account_code' => '5100',
                'account_desc'  => 'CAPITAL STOCK',
            ],
            [
                'account_code' => '5600',
                'account_desc'  => 'RETAINED EARNINGS',
            ],
            [
                'account_code' => '5601',
                'account_desc'  => 'UNEARNED REVENUE',
            ],
            [
                'account_code' => '6101',
                'account_desc'  => 'SALES - SERVICES',
            ],
            [
                'account_code' => '6102',
                'account_desc'  => 'SALES - PARTS',
            ],
            [
                'account_code' => '6103',
                'account_desc'  => 'SALES - SPQ',
            ],
            [
                'account_code' => '6104',
                'account_desc'  => 'SALES - ZERO RATED',
            ],
            [
                'account_code' => '6105',
                'account_desc'  => 'SALES - EXEMPT',
            ],
            [
                'account_code' => '6200',
                'account_desc'  => 'SALES - RETURNS',
            ],
            [
                'account_code' => '6201',
                'account_desc'  => 'SALES - DISCOUNT',
            ],
            [
                'account_code' => '6300',
                'account_desc'  => 'INTEREST INCOME',
            ],
            [
                'account_code' => '6301',
                'account_desc'  => 'DIVIDED INCOME',
            ],
            [
                'account_code' => '6302',
                'account_desc'  => 'MISCELLANEOUS INCOME',
            ],
            [
                'account_code' => '7110',
                'account_desc'  => 'MFG - 13TH MONTH - REGULAR',
            ],
            [
                'account_code' => '7110.1',
                'account_desc'  => 'MFG - 13TH MONTH - OJT',
            ],
            [
                'account_code' => '7110.2',
                'account_desc'  => 'MFG - 13TH MONTH - PROBY',
            ],
            [
                'account_code' => '7115',
                'account_desc'  => 'MFG - AMORTIZATION (LEASEHOLD IMPROVEMENT)',
            ],
            [
                'account_code' => '7120',
                'account_desc'  => 'MFG - CAPITALIZED EXPENDITURES (PRODUCTION)',
            ],
            [
                'account_code' => '7160',
                'account_desc'  => 'MFG - DEPRECIATION EXPENSE',
            ],
            [
                'account_code' => '7171',
                'account_desc'  => 'MFG - DIRECT LABOR (REGULAR-DAILY WAGES)',
            ],
            [
                'account_code' => '7172',
                'account_desc'  => 'MFG - DIRECT LABOR (OVERTIME)',
            ],
            [
                'account_code' => '7190',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - REPRESENTATION & ENTERTAINMENT',
            ],
            [
                'account_code' => '7191',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - HEALTH',
            ],
            [
                'account_code' => '7192',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - MEAL ALLOWANCE',
            ],
            [
                'account_code' => '7194',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - PRODUCTION',
            ],
            [
                'account_code' => '7195',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - TRANSPORTATION & TRAVEL',
            ],
            [
                'account_code' => '7196',
                'account_desc'  => 'MFG - EMPLOYEES BENEFITS - UNIFORMS',
            ],
            [
                'account_code' => '7200',
                'account_desc'  => 'MFG - FREIGHT & HANDLING',
            ],
            [
                'account_code' => '7230',
                'account_desc'  => 'MFG - GASOLINE & OIL',
            ],
            [
                'account_code' => '7235',
                'account_desc'  => 'MFG - HDMF EMPLOYER\'S CONT. EXPENSE',
            ],
            [
                'account_code' => '7240',
                'account_desc'  => 'MFG - INDEPENDENT CONTACTOR',
            ],
            [
                'account_code' => '7251',
                'account_desc'  => 'MFG - INSURANCE - ACCIDENT',
            ],
            [
                'account_code' => '7252',
                'account_desc'  => 'MFG - INSURANCE - LIFE',
            ],
            [
                'account_code' => '7253',
                'account_desc'  => 'MFG - INSURANCE - MACHINERIES & OFFICES',
            ],
            [
                'account_code' => '7254',
                'account_desc'  => 'MFG - INSURANCE - RETIREMENT',
            ],
            [
                'account_code' => '7255',
                'account_desc'  => 'MFG - INSURANCE - VEHICLES',
            ],
            [
                'account_code' => '7260',
                'account_desc'  => 'MFG - LIGHT',
            ],
            [
                'account_code' => '7270',
                'account_desc'  => 'MFG - MECHANIC BENEFITS',
            ],
            [
                'account_code' => '7301',
                'account_desc'  => 'MFG - MERCHANDISE INVENTORY - BEGINNING',
            ],
            [
                'account_code' => '7302',
                'account_desc'  => 'MFG - MERCHANDISE INVENTORY - END',
            ],
            [
                'account_code' => '7310',
                'account_desc'  => 'MFG - MISCELLANEOUSE EXPENSE',
            ],
            [
                'account_code' => '7325',
                'account_desc'  => 'MFG - PHILHEALTH EXPENSE',
            ],
            [
                'account_code' => '7331',
                'account_desc'  => 'MFG - PURCHASES - PARTS',
            ],
            [
                'account_code' => '7332',
                'account_desc'  => 'MFG - PURCHASES - PARTS',
            ],
            [
                'account_code' => '7333',
                'account_desc'  => 'MFG - PURCHASES - CALIBRATION PARTS',
            ],
            [
                'account_code' => '7340',
                'account_desc'  => 'MFG - RENT EXPENSE',
            ],
            [
                'account_code' => '7350',
                'account_desc'  => 'MFG - REPAIRS & MAINTENANCE (MACHINERIES & EQUIPMENT)',
            ],
            [
                'account_code' => '7351',
                'account_desc'  => 'MFG - REPAIRS & MAINT.(M/E) LABOR',
            ],
            [
                'account_code' => '7352',
                'account_desc'  => 'MFG - REPAIRS & MAINTENANCE (MEASURING INSTRUMENTS)',
            ],
            [
                'account_code' => '7353',
                'account_desc'  => 'MFG - REPAIRS & MAINT.(MEASURING INST) LABOR',
            ],
            [
                'account_code' => '7354',
                'account_desc'  => 'MFG - REPAIRS & MAINTENANCE (TRANSPORTATION)',
            ],
            [
                'account_code' => '7355',
                'account_desc'  => 'MFG - REPAIRS & MAINT.(TRANSPO) LABOR',
            ],
            [
                'account_code' => '7356',
                'account_desc'  => 'MFG - REPAIRS & MAINTENANCE (OFFICE/BLDG)',
            ],
            [
                'account_code' => '7357',
                'account_desc'  => 'MFG - REPAIRS & MAINT. (OFFICE/BLDG) LABOR',
            ],
            [
                'account_code' => '7359',
                'account_desc'  => 'MFG - RETIREMENT PAY',
            ],
            [
                'account_code' => '7360',
                'account_desc'  => 'MFG - SHOP OVERHEAD (OJT/DTS/TRAINEES)',
            ],
            [
                'account_code' => '7361',
                'account_desc'  => 'MFG - OVERTIME PAY (DTS/TRAINEES/OJT)',
            ],
            [
                'account_code' => '7380',
                'account_desc'  => 'MFG - SHOP OVERHEAD - PROBATIONARIES',
            ],
            [
                'account_code' => '7381',
                'account_desc'  => 'MFG - OVERTIME PAY (PROBATIONARIES)',
            ],
            [
                'account_code' => '7390',
                'account_desc'  => 'MFG - SSS/EC PREMIUM EXPENSE',
            ],
            [
                'account_code' => '7391',
                'account_desc'  => 'MFG - SEPARATION PAY',
            ],
            [
                'account_code' => '7410',
                'account_desc'  => 'MFG - THIRD PARTY CERTIFICATION',
            ],
            [
                'account_code' => '7420',
                'account_desc'  => 'MFG - TRAINING AND CERTIFICATION',
            ],
            [
                'account_code' => '7430',
                'account_desc'  => 'MFG - TRANSPORTATION & TRAVEL',
            ],
            [
                'account_code' => '7450',
                'account_desc'  => 'MFG - WATER',
            ],
            [
                'account_code' => '8110',
                'account_desc'  => 'OPEX - 13TH MONTH PAY',
            ],
            [
                'account_code' => '8120',
                'account_desc'  => 'OPEX - ADVERTISEMENT - DIRECTORIES',
            ],
            [
                'account_code' => '8121',
                'account_desc'  => 'OPEX - ADVERTISEMENT - XMAS GIVEAWAYS',
            ],
            [
                'account_code' => '8122',
                'account_desc'  => 'OPEX - ADVERTISEMENT - HIRING',
            ],
            [
                'account_code' => '8123',
                'account_desc'  => 'OPEX - ADVERTISEMENT - NEWSPAPER/PRINT',
            ],
            [
                'account_code' => '8124',
                'account_desc'  => 'OPEX - ADVERTISEMENT - SOLICITED',
            ],
            [
                'account_code' => '8130',
                'account_desc'  => 'OPEX - AMORTIZATION (LEASEHOLD IMPROVEMENTS)',
            ],
            [
                'account_code' => '8140',
                'account_desc'  => 'OPEX - BANK CHARGES',
            ],
            [
                'account_code' => '8160',
                'account_desc'  => 'OPEX - COMM. - CELLULAR PHONES',
            ],
            [
                'account_code' => '8162',
                'account_desc'  => 'OPEX - COMM. - CORRESPONDENCE',
            ],
            [
                'account_code' => '8164',
                'account_desc'  => 'OPEX - COMM. - INTERNET',
            ],
            [
                'account_code' => '8166',
                'account_desc'  => 'OPEX - COMM. - LANDLINES (GENERAL/ADMIN)',
            ],
            [
                'account_code' => '8170',
                'account_desc'  => 'OPEX - DEPRECIATION EXPENSES',
            ],
            [
                'account_code' => '8180',
                'account_desc'  => 'OPEX - DONATION',
            ],
            [
                'account_code' => '8191',
                'account_desc'  => 'OPEX - EMPLOYEES BENEFITS (SALES)',
            ],
            [
                'account_code' => '8201',
                'account_desc'  => 'OPEX - GAS & OIL - ADMINISTRATION',
            ],
            [
                'account_code' => '8202',
                'account_desc'  => 'OPEX - GAS & OIL - SALES',
            ],
            [
                'account_code' => '8205',
                'account_desc'  => 'OPEX - HDMF CONTRIBUTION EXPENSE',
            ],
            [
                'account_code' => '8211',
                'account_desc'  => 'OPEX - INSURANCE - EQUIPMENTS AND OFFICES (STAFF)',
            ],
            [
                'account_code' => '8212',
                'account_desc'  => 'OPEX - INSURANCE - HEALTH/LIFE (ADMINISTRATIVE)',
            ],
            [
                'account_code' => '8220',
                'account_desc'  => 'OPEX - INTEREST EXPENSE - BANKS',
            ],
            [
                'account_code' => '8230',
                'account_desc'  => 'OPEX - LIGHT - ADMIN',
            ],
            [
                'account_code' => '8240',
                'account_desc'  => 'OPEX - MEAL ALLOWANCE - ADMIN/OPERATIONS',
            ],
            [
                'account_code' => '8260',
                'account_desc'  => 'OPEX - MEMBERSHIP DUES & SUBS. - LOCAL',
            ],
            [
                'account_code' => '8261',
                'account_desc'  => 'OPEX - MEMBERSHIP DUES & SUBS. - INTERNATIONAL',
            ],
            [
                'account_code' => '8270',
                'account_desc'  => 'OPEX - MISCELLANEOUS EXPENSE',
            ],
            [
                'account_code' => '8281',
                'account_desc'  => 'OPEX - OFFICE SUPPLIES - BOOKS/MANUALS',
            ],
            [
                'account_code' => '8282',
                'account_desc'  => 'OPEX - OFFICE SUPPLIES - MISCELLANEOUS',
            ],
            [
                'account_code' => '8283',
                'account_desc'  => 'OPEX - OFFICE SUPPLIES - STANDARD FORMS',
            ],
            [
                'account_code' => '8295',
                'account_desc'  => 'OPEX - PHILHEALTH CONTRIBUTION EXPENSE',
            ],
            [
                'account_code' => '8301',
                'account_desc'  => 'OPEX - PROFESSIONAL FEES - FINANCE',
            ],
            [
                'account_code' => '8302',
                'account_desc'  => 'OPEX - PROFESSIONAL FEES - CERTIFICATION (AUDIT)',
            ],
            [
                'account_code' => '8303',
                'account_desc'  => 'OPEX - PROFESSIONAL FEES - LEGAL',
            ],
            [
                'account_code' => '8304',
                'account_desc'  => 'OPEX - PROFESSIONAL FEES - MANAGERIAL',
            ],
            [
                'account_code' => '8310',
                'account_desc'  => 'OPEX - REP & MAINT - ADMINISTRATION',
            ],
            [
                'account_code' => '8311',
                'account_desc'  => 'OPEX - REP & MAINT - (ADMIN) LABOR',
            ],
            [
                'account_code' => '8312',
                'account_desc'  => 'OPEX - REP & MAINT - OFFICE EQUIPMENT',
            ],
            [
                'account_code' => '8313',
                'account_desc'  => 'OPEX - REP & MAINT - (OFFICE EQUIPT) LABOR',
            ],
            [
                'account_code' => '8313',
                'account_desc'  => 'OPEX - REP & MAINT - (OFFICE EQUIPT) LABOR',
            ],
            [
                'account_code' => '8314',
                'account_desc'  => 'OPEX - REP & MAINT - TRANSPO (SALES)',
            ],
            [
                'account_code' => '8315',
                'account_desc'  => 'OPEX - REP & MAINT - (TRANSPO-SALES) LABOR',
            ],
            [
                'account_code' => '8316',
                'account_desc'  => 'OPEX - REP & MAINT - TRANSPO (STAFF)',
            ],
            [
                'account_code' => '8317',
                'account_desc'  => 'OPEX - REP & MAINT - (TRANSPO-STAFF) LABOR',
            ],
            [
                'account_code' => '8321',
                'account_desc'  => 'OPEX - REPR. & ENTERTAINMENT (SALES/ADMIN)',
            ],
            [
                'account_code' => '8330',
                'account_desc'  => 'OPEX - SALARIES & WAGES (STAFF COMPENSATION)',
            ],
            [
                'account_code' => '8331',
                'account_desc'  => 'OPEX - OVERTIME PAY (STAFF COMPENSATION)',
            ],
            [
                'account_code' => '8340',
                'account_desc'  => 'OPEX - SEMINARS & TRAININGS (CEO)',
            ],
            [
                'account_code' => '8350',
                'account_desc'  => 'OPEX - SEPARATION PAY',
            ],
            [
                'account_code' => '8360',
                'account_desc'  => 'OPEX - SSS/EC PREMIUM EXPENSE',
            ],
            [
                'account_code' => '8370',
                'account_desc'  => 'OPEX - TAXES & LICENSES',
            ],
            [
                'account_code' => '8380',
                'account_desc'  => 'OPEX - TECHNICAL TRAINING (SALES/ADMIN)',
            ],
            [
                'account_code' => '8390',
                'account_desc'  => 'OPEX - TRANSPORTATION & TRAVEL - ADMIN/SALES',
            ],
            [
                'account_code' => '8400',
                'account_desc'  => 'OPEX - WATER',
            ],
            [
                'account_code' => '9100',
                'account_desc'  => 'PROVISION FOR INCOME TAX',
            ],
            [
                'account_code' => '9200',
                'account_desc'  => 'OTHER NON-DEDUCTIBLE EXPENSE',
            ]
        ];
    
        ChartOfAccounts::insert($list);
    }
}
