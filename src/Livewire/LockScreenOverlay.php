<?php


namespace MohamedElsayedIbrahim\FilamentLockScreen\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use MohamedElsayedIbrahim\FilamentLockScreen\Events\Unlocked;

class LockScreenOverlay extends Component
{
    public bool $locked = false;
    public string $password = '';

    public function mount()
    {
        $this->locked = session('fls_locked', false);
    }

    public function unlock()
    {
        if (!Hash::check($this->password, auth()->user()->password)) {
            return;
        }

        session()->forget('fls_locked');

        event(new Unlocked(auth()->user()));

        $this->locked = false;
    }

    public function render()
    {
        return view('filament-lock-screen::livewire.overlay');
    }
}