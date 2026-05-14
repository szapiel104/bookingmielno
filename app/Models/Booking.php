<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in_date',
        'check_out_date',
        'number_of_nights',
        'price_per_night',
        'total_price',
        'special_requests',
        'status',
        'admin_notes',
        'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'check_in_date' => 'date',
            'check_out_date' => 'date',
            'confirmed_at' => 'datetime',
            'price_per_night' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'Pending' => 'warning',
            'Confirmed' => 'success',
            'Cancelled' => 'danger',
            default => 'secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'Pending' => 'Oczekująca',
            'Confirmed' => 'Potwierdzona',
            'Cancelled' => 'Anulowana',
            default => 'Nieznana',
        };
    }
}
