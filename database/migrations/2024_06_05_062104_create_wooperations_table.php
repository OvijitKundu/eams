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
        Schema::create('wooperations', function (Blueprint $table) {
            $table->unsignedBigInteger('workorder_id');
            $table->foreign('workorder_id')->references('id')->on('workorders')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('operation_id');
            $table->foreign('operation_id')->references('id')->on('operations')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('resoulation',300)->nullable();

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('duration')->nullable();
            $table->string('started_at')->nullable();
            $table->string('ended_at')->nullable();
            
          

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
        Schema::dropIfExists('wooperations');
    }
};
