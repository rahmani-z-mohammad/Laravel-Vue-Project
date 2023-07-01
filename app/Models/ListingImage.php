<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    public function listing(): BelongsTo {
        // we dont write the second argument column name while Laravel know autumaticlly the primary and forign key
        return $this->belongsTo(Listing::class);
    }
}
