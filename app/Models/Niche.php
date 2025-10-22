<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Niche extends Model
{
    protected $table = 'niches';
    protected $fillable = [
        'niche',
        'habitat_id',
        'niche_data',
        'created_at',
    ];
    protected $casts = [
        'niche_data' => 'array',
    ];
    public $timestamps = false;

    public function habitat()
    {
        return $this->belongsTo(Habitat::class);
    }

    public function usersDataFlex()
    {
        return $this->hasMany(UsersDataFlex::class);
    }
}
