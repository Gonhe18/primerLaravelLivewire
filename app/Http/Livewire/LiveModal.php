<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Requests\RequestUpdate;

class LiveModal extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $apellido = '';
    public $email = '';
    public $role = '';
    public $user = null;
    public $action = "";
    public $method = "";

    protected $listeners = [
        "showModal" => "mostrarModal",
        'showModalNewUser' => "mostrarModalNuevo"
    ];



    public function render()
    {
        return view('livewire.live-modal');
    }

    public function mostrarModal(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->apellido = $user->r_lastname->apellido;
        $this->email = $user->email;
        $this->role = $user->role;

        $this->action = "Actualizar";
        $this->method = "actualizarUsuario";

        $this->showModal = '';
    }

    public function mostrarModalNuevo()
    {
        $this->user = null;
        $this->action = "Registrar";
        $this->method = "registrarUsuario";

        $this->showModal = '';
    }

    public function cerrarModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function actualizarUsuario()
    {
        $requestUser = new RequestUpdate();
        $value = $this->validate($requestUser->rules($this->user), $requestUser->messages());

        $this->user->update($value);
        $this->user->r_lastname()->update(['apellido' => $value['apellido']]);

        $this->emit('userListUpdate');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function updated($label)
    {
        $requestUser = new RequestUpdate();
        $this->validateOnly($label, $requestUser->rules($this->user), $requestUser->messages());
    }

    public function registrarUsuario()
    {
        $requestUser = new RequestUpdate();
    }
}