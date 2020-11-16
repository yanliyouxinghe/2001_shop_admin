<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
     protected $table = 'sh_goods';
      protected $guarded = [];
      protected $primaryKey = "goods_id";
      public $timestamps = false;
}
