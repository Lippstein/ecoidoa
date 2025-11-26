<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    public $timestamps = false; // Remove if you add timestamps to the migration

    protected $fillable = [
        'id_term_bt',
        'id_term_nt',
        'id_niche',
        'id_user',
        'term_order',
    ];

    /**
     * Broader term (bt) relation.
     */
    public function termBt()
    {
        return $this->belongsTo(Term::class, 'id_term_bt');
    }

    /**
     * Narrower term (nt) relation.
     */
    public function termNt()
    {
        return $this->belongsTo(Term::class, 'id_term_nt');
    }

    /**
     * Niche relation.
     */
    public function niche()
    {
        return $this->belongsTo(Niche::class, 'id_niche');
    }

    /**
     * User who created the relation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
