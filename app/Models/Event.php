<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'description', 'category', 'base_price', 'total_capacity', 'status', 'start_date', 'end_date'])]
class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $casts = [
                'base_price' => 'decimal:2',
                'start_date' => 'date',
                'end_date' => 'date'
            ];



    protected static function boot() {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) $event->slug = Str::slug($event->title);
        });
    }



    /** @return HasMany<EventSchedule, $this> */
    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class);
    }




}
