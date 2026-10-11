<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_id', 'event_schedule_id', 'status', 'total_amount', 'payment_status', 'booked_at'])]
class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $casts = ['total_amount' => 'decimal:2', 'booked_at' => 'datetime'];



    /** @return BelongsTo<Customer, $this> */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


    /** @return BelongsTo<EventSchedule, $this> */
    public function eventSchedule(): BelongsTo
    {
        return $this->belongsTo(EventSchedule::class);
    }


    /** @return HasMany<BookingAttendee, $this> */
    public function attendees(): HasMany
    {
        return $this->hasMany(BookingAttendee::class);
    }





}
