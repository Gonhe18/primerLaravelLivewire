<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LiveUserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $campo = null;
    public $orden = null;
    public $icon = "-circle";

    // Permite mantener filtros cuando la página se recarga
    protected $queryString = [
        'search' => ['except' => ""],
        'campo' => ['except' => null],
        'orden' => ['except' => null],
    ];

    public function render()
    {
        $users = User::where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%");
        // Permite un orden dinámico
        if ($this->campo && $this->orden) {
            $users = $users->orderBy($this->campo, $this->orden);
        } else {
            $this->campo = null;
            $this->orden = null;
        }

        $users = $users->paginate($this->perPage);

        return view('livewire.live-user-table', [
            'users' => $users
        ]);
    }

    public function mount()
    {
        $this->icon = $this->iconDirection($this->orden);
    }

    // Resetea todos los filtros
    public function clear()
    {
        $this->resetPage();
        $this->campo = null;
        $this->orden = null;
        $this->icon = "-circle";
        $this->search = "";
        $this->perPage = 5;
    }

    // Resetea paginación para busquedas desde search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Orden el listado, modificando también el icono
    public function sortable($campo)
    {
        // Permite que el orden sea independiente
        if ($campo !== $this->campo) {
            $this->orden = null;
        }
        switch ($this->orden) {
            case null:
                $this->orden = 'asc';
                break;
            case 'asc':
                $this->orden = 'desc';
                break;
            case 'desc':
                $this->orden = null;
                break;
        }
        $this->icon = $this->iconDirection($this->orden);
        $this->campo = $campo;
    }

    public function iconDirection($sort)
    {
        if (!$sort) {
            return "-circle";
        }
        return $sort == 'asc' ? "-circle-arrow-up" : "-circle-arrow-down";
    }
}