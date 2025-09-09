<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitat extends Model
{
    protected $table = 'habitats';
    protected $fillable = [
        'habitat',
        'habitat_data',
        'created_at',
    ];
    protected $casts = [
        'habitat_data' => 'array',
    ];

    public $timestamps = false;

    public function niches()
    {
        return $this->hasMany(Niche::class);
    }
}
