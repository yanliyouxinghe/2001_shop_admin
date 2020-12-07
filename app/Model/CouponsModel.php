<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CouponsModel extends Model
{
     //指定表名
     protected $table = 'sh_coupons';
     //指定主键
     protected $primaryKey = 'coupons_id';
     //不自动添加时间 
     public $timestamps = false;
     //黑名单
     protected $guarded=[];
}
