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
        Schema::create('wopermits', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('permissionNote')->nullable();
            $table->string('started_at')->nullable();           
            $table->string('ended_at')->nullable();           
            $table->string('panel_memebers')->nullable();           
            $table->string('superVisor')->nullable();           
           
           
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')
            ->cascadeOnUpdate()->restrictOnDelete();
           

            $table->unsignedBigInteger('workorder_id');
            $table->foreign('workorder_id')->references('id')->on('workorders')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('updated_by')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
           
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wopermits');
    }
};
