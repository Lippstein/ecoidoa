<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'term',
        'definition',
        'language',
        'id_niche',
    ];

    protected $casts = [
        'term_data' => 'array',
    ];

    /**
     * Get all the relations where this term is the broader term (bt).
     */
    public function relationsBT()
    {
        return $this->hasMany(Relation::class, 'id_term_bt')->orderBy('id_niche');
    }

    /**
     * Get all the relations where this term is the narrower term (nt).
     */
    public function relationsNT()
    {
        return $this->hasMany(Relation::class, 'id_term_nt')->orderBy('id_niche');
    }
}
