<?php

use App\Models\Company;
use App\Models\User;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->date('date_issued');
            $table->date('due_date');
            $table->decimal('deposit_requested')->nullable();
            $table->decimal('deposit_due')->nullable();
            $table->decimal('subtotal');
            $table->decimal('discount')->nullable();
            $table->decimal('tax');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
