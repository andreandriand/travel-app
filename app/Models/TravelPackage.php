<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;

    protected $table = 'travel_packages';

    protected $fillable = [
        'title', 'slug', 'location', 'about', 'featured_event', 'language', 'foods', 'depature_date', 'duration', 'type', 'price'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'travel_package_id', 'id');
    }
}
