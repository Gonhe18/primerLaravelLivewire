<?php

namespace App\Http\Livewire;

use App\Models\Apellido;
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
    public $user_role;

    protected $listeners = [
        'userListUpdate' => 'render',
        'deleteUsuario' => 'deleteUser'
    ];

    // Permite mantener filtros cuando la página se recarga
    protected $queryString = [
        'search' => ['except' => ""],
        'campo' => ['except' => null],
        'orden' => ['except' => null],
    ];

    public function render()
    {
        $users = User::termino($this->search)
            ->role($this->user_role);
        // Permite un orden dinámico
        if ($this->campo && $this->orden) {
            if ($this->campo === "apellido") {
                $users = $users->orderBy(Apellido::select('apellido')
                    ->whereColumn('apellidos.user_id', 'users.id'), $this->orden);
            } else {
                $users = $users->orderBy($this->campo, $this->orden);
            }
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
        $this->reset();
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

    public function showModal(User $user)
    {
        if ($user->name) {
            $this->emit("showModal", $user);
        } else {
            $this->emit("showModalNewUser");
        }
    }
    public function deleteUser(User $user)
    {
        $user->r_lastname()->delete();
        $user->delete();
        $this->emit("deleteUser", $user);
    }
}