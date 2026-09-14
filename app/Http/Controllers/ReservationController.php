<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Machine;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Auth::user()
            ->reservations()
            ->with('machine')
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Request $request): View
    {
        $machines = Machine::where('disponible', true)->orderBy('numero')->get();
        $selected = $request->integer('machine');

        return view('reservations.create', compact('machines', 'selected'));
    }

    public function store(StoreReservationRequest $request): RedirectResponse
    {
        Auth::user()->reservations()->create([
            'machine_id' => $request->validated('machine_id'),
            'fecha' => $request->validated('fecha'),
            'hora_inicio' => $request->validated('hora_inicio'),
            'hora_fin' => $request->horaFin(),
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('status', 'Reserva registrada correctamente.');
    }

    public function cancel(Reservation $reservation): RedirectResponse
    {
        abort_unless($reservation->user_id === Auth::id(), 403);

        if (! $reservation->puedeCancelarse()) {
            return back()->with('error', 'Solo puedes cancelar reservas pendientes con al menos 2 horas de anticipación.');
        }

        $reservation->update(['estado' => 'cancelada']);

        return back()->with('status', 'Reserva cancelada correctamente.');
    }
}
