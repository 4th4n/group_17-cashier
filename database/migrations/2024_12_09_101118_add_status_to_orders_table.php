<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Or use a different column type and default value if needed
        });
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
};
