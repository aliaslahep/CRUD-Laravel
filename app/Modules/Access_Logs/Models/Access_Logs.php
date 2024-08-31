<?php

namespace App\Modules\Access_Logs\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Access_Logs extends Model
{
    use HasFactory;

    protected $table = "access_logs";
 
    protected function accesslog(): Attribute
    {
        return Attribute::make(

            get: fn (string $value) => date('d M Y h:i a',strtotime($value))
        
        );
    }

}

