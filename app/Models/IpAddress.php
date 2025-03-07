<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $ip_address
 * @property string $latitude
 * @property string $longitude
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $isp
 */
class IpAddress extends Model
{
    protected $primaryKey = 'ip_address';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
}
