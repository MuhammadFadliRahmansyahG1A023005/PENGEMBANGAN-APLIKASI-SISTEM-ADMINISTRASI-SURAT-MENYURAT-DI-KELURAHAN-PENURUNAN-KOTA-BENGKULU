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
        Schema::table('surat', function (Blueprint $col) {
            $col->string('dibawa_ke_kantor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat', function (Blueprint $col) {
            $col->dropColumn('dibawa_ke_kantor');
        });
    }
};
