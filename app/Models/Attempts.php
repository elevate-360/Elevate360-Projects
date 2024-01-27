<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attempts extends Model
{
    protected $table = 'tblAttempts';
    protected $primaryKey = 'atpId';

    // Disable timestamps for this model
    public $timestamps = false;
}
