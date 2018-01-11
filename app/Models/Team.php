<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  protected $fillable = [
      'name',
      'table_name',
      'city',
      'logo',
      'small_logo',
      'foto',
      'president',
      'manager',
      'manager_num',
      'web',
      'info'
  ];
  public $timestamps = false;
    //
}
