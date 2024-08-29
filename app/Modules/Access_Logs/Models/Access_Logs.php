<?php

namespace App\Modules\Access_Logs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_Logs extends Model
{
    use HasFactory;

    protected $table = "access_logs";
    
}
