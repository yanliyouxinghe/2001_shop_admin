<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'sh_order_info';
      protected $guarded = [];
      protected $primaryKey = "order_id";

      public $timestamps = false;
}
