<?php

namespace App\Models;

use App\Events\ChirpCreated;
use App\Events\ChirpUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    protected $fillable = ['message', 'title', 'user_id'];

    // タイムスタンプを自動的に管理する
    public $timestamps = true; 

    use HasFactory;   
    
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
        'updated' => ChirpUpdated::class,
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }  
}
