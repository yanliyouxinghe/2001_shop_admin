<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdvModel extends Model
{
     //指定表名
     protected $table = 'sh_adv';
     //指定主键
     protected $primaryKey = 'adv_id';
     //不自动添加时间 
     public $timestamps = false;
     //黑名单
     protected $guarded=[];
}
