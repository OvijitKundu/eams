<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->string('workorder_no')->nullable();
            $table->string('failure_cause',300)->nullable();
            $table->string('workorder_type')->nullable();
            $table->string('priority')->nullable();
            $table->string('before_efficiency')->nullable();
            $table->string('after_efficiency')->nullable();
            $table->string('status')->nullable();//draft/released/complete
            $table->string('approval_stas')->nullable();
            $table->string('approve_stats_by')->nullable();
           
            $table->unsignedBigInteger('assetitem_id');
            $table->foreign('assetitem_id')->references('id')->on('assetitems')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('workshop_id');
            $table->foreign('workshop_id')->references('id')->on('workshops')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('updated_by')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
           
            $table->index('workorder_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workorders');
    }
};
