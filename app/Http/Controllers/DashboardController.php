<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->isPersonal()) {
            return $this->personalDashboard();
        }

        return $this->estudianteDashboard();
    }

    private function estudianteDashboard(): View
    {
        $user = Auth::user();

        $reservations = $user->reservations()->with('machine')->get();

        $stats = [
            'activas' => $reservations->whereIn('estado', ['pendiente', 'en_proceso'])->count(),
            'pendientes' => $reservations->where('estado', 'pendiente')->count(),
            'finalizadas' => $reservations->where('estado', 'finalizada')->count(),
            'disponibles' => Machine::where('disponible', true)->count(),
        ];

        $proximas = $reservations
            ->whereIn('estado', ['pendiente', 'en_proceso'])
            ->sortBy(fn ($r) => $r->fecha->format('Y-m-d').' '.$r->hora_inicio)
            ->take(3);

        return view('dashboard.estudiante', compact('stats', 'proximas'));
    }

    private function personalDashboard(): View
    {
        $reservations = \App\Models\Reservation::with(['user', 'machine'])->get();

        $stats = [
            'pendientes' => $reservations->where('estado', 'pendiente')->count(),
            'en_proceso' => $reservations->where('estado', 'en_proceso')->count(),
            'finalizadas' => $reservations->where('estado', 'finalizada')->count(),
            'canceladas' => $reservations->where('estado', 'cancelada')->count(),
        ];

        $recientes = $reservations
            ->sortByDesc(fn ($r) => $r->created_at)
            ->take(5);

        return view('dashboard.personal', compact('stats', 'recientes'));
    }
}
