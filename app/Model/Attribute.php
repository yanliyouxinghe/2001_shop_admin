<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
  protected $table = 'sh_attribute';
 protected $guarded = [];
 protected $primaryKey = "attr_id";

//  protected $fillable = ['attr_name','attr_values'];
 public $timestamps = false;
}
