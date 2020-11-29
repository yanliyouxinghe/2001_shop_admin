<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SeuserModel extends Model
{
    protected $table = 'sh_seuser';
    protected $guarded = [];
    protected $primaryKey = "seuser_id";

    public $timestamps = false;
}
