<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $investors = DB::table('investors')->get();
        foreach ($investors as $investor) {
            if (! empty($investor->account_number)) {
                DB::table('bank_accounts')->insert([
                    'investor_id' => $investor->id,
                    'account_holder_name' => $investor->account_holder_name ?? $investor->name,
                    'bank_name' => $investor->bank_name,
                    'account_number' => $investor->account_number,
                    'ifsc_code' => $investor->ifsc_code,
                    'branch_name' => $investor->branch_name,
                    'account_type' => $investor->account_type ?? 'Savings',
                    'is_primary' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn([
                'bank_name',
                'account_number',
                'ifsc_code',
                'account_holder_name',
                'branch_name',
                'account_type',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_type')->nullable();
        });

        $bankAccounts = DB::table('bank_accounts')->where('is_primary', true)->get();
        foreach ($bankAccounts as $account) {
            DB::table('investors')->where('id', $account->investor_id)->update([
                'bank_name' => $account->bank_name,
                'account_number' => $account->account_number,
                'ifsc_code' => $account->ifsc_code,
                'account_holder_name' => $account->account_holder_name,
                'branch_name' => $account->branch_name,
                'account_type' => $account->account_type,
            ]);
        }
    }
};
