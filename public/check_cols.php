<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();


if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'foto')) {
    \Illuminate\Support\Facades\Schema::table('users', function ($table) {
        $table->string('foto')->nullable();
    });
    echo "Column foto added.";
} else {
    echo "Column foto already exists.";
}
