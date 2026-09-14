<?php

namespace App\Http\Requests;

use App\Models\Machine;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreReservationRequest extends FormRequest
{
    public const DURACION_HORAS = 1;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isEstudiante() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'machine_id' => ['required', 'exists:machines,id'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $user = $this->user();

            if ($user->reservations()->whereIn('estado', ['pendiente', 'en_proceso'])->count() >= 3) {
                $validator->errors()->add('machine_id', 'Ya tienes el máximo de 3 reservas activas.');

                return;
            }

            $machine = Machine::find($this->input('machine_id'));

            if (! $machine || ! $machine->disponible) {
                $validator->errors()->add('machine_id', 'La máquina seleccionada no está disponible.');

                return;
            }

            $horaInicio = $this->input('hora_inicio');
            $horaFin = Carbon::createFromFormat('H:i', $horaInicio)
                ->addHours(self::DURACION_HORAS)
                ->format('H:i');

            if ($machine->estaOcupadaEn($this->input('fecha'), $horaInicio, $horaFin)) {
                $validator->errors()->add('hora_inicio', 'La máquina ya está reservada en ese horario.');
            }
        });
    }

    public function horaFin(): string
    {
        return Carbon::createFromFormat('H:i', $this->validated('hora_inicio'))
            ->addHours(self::DURACION_HORAS)
            ->format('H:i');
    }
}
