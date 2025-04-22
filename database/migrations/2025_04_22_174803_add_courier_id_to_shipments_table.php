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
        Schema::table('shipments', function (Blueprint $table) {
            $table->unsignedBigInteger('courier_id')->nullable()->after('destination');
    
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
   
public function down()
{
    Schema::table('shipments', function (Blueprint $table) {
        $table->dropForeign(['courier_id']);
        $table->dropColumn('courier_id');
    });
}
};
