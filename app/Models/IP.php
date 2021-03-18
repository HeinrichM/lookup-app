<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'version',
        'city',
        'region',
        'region_code',
        'country',
        'country_name',
        'country_code',
        'country_code_iso3',
        'continent_code',
        'org',
        'status',
    ];

    /**
     * Get the ip address status.
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return $value ? 'Allowed' : 'Blocked';
    }

    /**
     * Get the ip address continent.
     *
     * @return string
     */
    public function getContinentCodeAttribute($value)
    {
        switch($value){
            case 'AF' : return 'Africa';
            case 'AN' : return 'Antarctica';
            case 'AS' : return 'Asia';
            case 'EU' : return 'Europe';
            case 'NA' : return 'North america';
            case 'OC' : return 'Oceania';
            case 'SA' : return 'South america';
        }
    }

}
