<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function getDateOfBirthAttribute($value)
    {
        // Format the date using Carbon or any other date manipulation library
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
    public function setDateOfBirthAttribute($value)
    {
        // Format the date using Carbon or any other date manipulation library
        info( $value);
        $this->attributes['date_of_birth'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }
}
