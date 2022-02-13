<?php

namespace Ajifatur\FaturHelper\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visitors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address', 'device', 'browser', 'platform', 'location'
    ];

    /**
     * Get the user that owns the visitor.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
