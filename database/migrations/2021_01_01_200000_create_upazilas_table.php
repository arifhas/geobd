<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUpazilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('bn_name', 50)->nullable();
            $table->foreignId('district_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->dropForeign('upazilas_district_id_foreign');
        });

        Schema::dropIfExists('upazilas');
    }
}
