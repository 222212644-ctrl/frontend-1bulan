<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $isMenuOpen = false;

    // Toggle menu state for mobile view
    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    public function render()
    {
        return view('livewire.header');
    }
}
