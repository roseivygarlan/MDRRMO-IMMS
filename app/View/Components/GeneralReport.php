<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
use App\Models\Equipment;

class GeneralReport extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = User::get();
        $equipment = Equipment::get();
        $userActivated = $user->where('status', 'Activated')->count();
        $userDeactivated = $user->where('status', 'Deactivated')->count();
        $userBlocked = $user->where('status', 'Blocked')->count();
        $userPending = $user->where('status', 'Pending')->count();

        $equipmentCount = $equipment->sum('quantity');
        return view('components.general-report', compact('userActivated','userDeactivated','userBlocked','userPending', 'equipmentCount'));
    }
}
