<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\View\View;

class MachineController extends Controller
{
    public function index(): View
    {
        $machines = Machine::orderBy('numero')->get();

        return view('machines.index', compact('machines'));
    }
}
