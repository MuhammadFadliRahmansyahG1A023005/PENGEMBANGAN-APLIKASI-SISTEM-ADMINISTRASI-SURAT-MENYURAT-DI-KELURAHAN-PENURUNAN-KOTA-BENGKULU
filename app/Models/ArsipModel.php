<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipModel extends Model
{
    protected $table = 'arsip';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
