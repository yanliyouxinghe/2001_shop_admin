<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SegoodsModel extends Model
{
     //指定表名
    protected $table = 'sh_segoods';
    //指定主键
    protected $primaryKey = 'goods_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
