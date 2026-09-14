<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with(['user', 'machine'])
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio')
            ->get();

        return view('personal.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $request->validate([
            'estado' => ['required', 'in:pendiente,en_proceso,finalizada,cancelada'],
        ]);

        $reservation->update(['estado' => $request->string('estado')]);

        return back()->with('status', 'Estado de la reserva actualizado.');
    }
}
