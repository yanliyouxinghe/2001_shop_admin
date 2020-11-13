<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartgoryModel extends Model
{
      protected $table = 'sh_category';
      protected $guarded = [];
      protected $primaryKey = "cat_id";

      public $timestamps = false;
}
