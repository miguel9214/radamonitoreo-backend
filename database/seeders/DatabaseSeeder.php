<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            SaleSeeder::class,
            PurchaseSeeder::class,
            InventorySeeder::class,
            QuotationSeeder::class,
            ExpenseSeeder::class,
            AccountsReceivableSeeder::class,
            AccountsPayableSeeder::class,
            CashRegisterSeeder::class,
            BestSellingSeeder::class,
            LeastSellingSeeder::class,
            IncomeQuerySeeder::class,
            IncomeStatementSeeder::class,
            ConfigurationSeeder::class,
            UpdateCustomersWithDniSeeder::class,
            UpdateSuppliersSeeder::class,
        ]);
    }
}
