<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Requests\RequestUpdate;
use App\Models\Apellido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class LiveModal extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $name = '';
    public $apellido = '';
    public $email = '';
    public $role = '';
    public $user = null;
    public $action = "";
    public $method = "";
    public $password = "";
    public $password_confirmation = "";
    public $profile_photo_path = null;

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

        $this->removeImage($this->user->profile_photo_path);
        if ($value['profile_photo_path']) {
            $profile = ['profile_photo_path' => $this->loadImage($value['profile_photo_path'])];
            $value = array_merge($value, $profile);
        }


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
        $values = $this->validate($requestUser->rules($this->user), $requestUser->messages());

        $user = new User;
        $apellido = new Apellido;
        $apellido->apellido = $values['apellido'];

        if ($values['profile_photo_path']) {
            $user->profile_photo_path = $this->loadImage($values['profile_photo_path']);
        }

        $user->fill($values);
        $user->password = bcrypt($values['password']);
        $user->save();
        $apellido->r_user()->associate($user)->save();

        $this->cerrarModal();
    }

    private function loadImage(TemporaryUploadedFile $image)
    {
        $extension = $image->getClientOriginalExtension();

        $location = Storage::disk('public')->put('img', $image);

        return $location;
    }
    private function removeImage($profile_photo_path)
    {
        if (!$profile_photo_path) {
            return;
        }
        if (Storage::disk('public')->exists($profile_photo_path)) {
            Storage::disk('public')->delete($profile_photo_path);
        }
    }
}