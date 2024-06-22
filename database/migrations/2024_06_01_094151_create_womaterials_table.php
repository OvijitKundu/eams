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
        Schema::create('womaterials', function (Blueprint $table) {
            $table->id();
            $table->string('quantity')->nullable();
            $table->string('required_date')->nullable();
            $table->string('activities')->nullable();  

            $table->unsignedBigInteger('spartpart_id');
            $table->foreign('spartpart_id')->references('id')->on('spartparts')
            ->cascadeOnUpdate()->restrictOnDelete();  

            $table->unsignedBigInteger('uom_id');
            $table->foreign('uom_id')->references('id')->on('uoms')
            ->cascadeOnUpdate()->restrictOnDelete();  
            
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('workorder_id');
            $table->foreign('workorder_id')->references('id')->on('workorders')
            ->cascadeOnUpdate()->restrictOnDelete();

           


            $table->unsignedBigInteger('operation_id');
            $table->foreign('operation_id')->references('id')->on('operations')
            ->cascadeOnUpdate()->restrictOnDelete();

            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('updated_by')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('womaterials');
    }
};
