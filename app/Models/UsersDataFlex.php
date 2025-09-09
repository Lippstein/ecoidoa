<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDataFlex extends Model
{
    protected $table = 'users_data_flex';
    protected $fillable = [
        'user_id',
        'habitat_id',
        'niche_id',
        'user_data_flex',
        'created_at',
    ];
    protected $casts = [
        'user_data_flex' => 'array',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habitat()
    {
        return $this->belongsTo(Habitat::class);
    }

    public function niche()
    {
        return $this->belongsTo(Niche::class);
    }
}
