<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    public const ESTADOS = ['pendiente', 'en_proceso', 'finalizada', 'cancelada'];

    protected $fillable = [
        'user_id',
        'machine_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function inicioProgramado(): Carbon
    {
        return Carbon::parse($this->fecha->format('Y-m-d').' '.$this->hora_inicio);
    }

    public function puedeCancelarse(): bool
    {
        if ($this->estado !== 'pendiente') {
            return false;
        }

        return now()->diffInMinutes($this->inicioProgramado(), false) >= 120;
    }
}
