<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Mailbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip',
        'name',
        'type',
        'a0_name',
        'a1_name',
        'a2_name',
        'a3_name',
        'a4_name',
        'a5_name',
        'a6_name',
        'a7_name',
        'a8_name',
        'x_coordinate',
        'y_coordinate',
        'service_hours',
        'temp_service_hours',
        'temp_service_hours_until',
        'temp_service_hours_2',
        'temp_service_hours_2_until',
        'comment_est',
        'comment_eng',
        'comment_rus',
        'comment_lav',
        'comment_lit',
        'modified',
    ];

    public function scopeNearby(Builder $query, float $lat, float $lon): void
    {
        $query->selectRaw(
            '*, ( 6371 * acos( cos( radians(?) )
             * cos( radians( y_coordinate ) )
             * cos( radians( x_coordinate )
             - radians(?) ) + sin( radians(?) )
             * sin( radians( y_coordinate ) ) ) )
             AS distance',
            [$lat, $lon, $lat]
        );
    }
}
