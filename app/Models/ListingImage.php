<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];
    protected $appends = ['src'];

    public function listing(): BelongsTo {
        // we dont write the second argument column name while Laravel know autumaticlly the primary and forign key
        return $this->belongsTo(Listing::class);
    }

    //getRealSrcAttribute -> real_src
    public function getSrcAttribute(){
        return asset("storage/{$this->filename}");
    }
}
