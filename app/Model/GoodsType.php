<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
  protected $table = 'sh_goodstype';
  protected $guarded = [];
  protected $primaryKey = "cat_id";

  // protected $fillable = ['cat_name','enabled','attr_group'];
  public $timestamps = false;
}
