<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
