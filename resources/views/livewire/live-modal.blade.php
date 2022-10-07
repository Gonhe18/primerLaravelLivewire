<div>
   <form wire:submit.prevent="{{ $method }}">
      <x-component-modal :showModal="$showModal" :action="$action">
         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edición de usuario</h3>
            <div class="mt-2">
               <p class="text-sm text-gray-500">
               <div class="flex">
                  <x-component-input :label="'Nombre'" :placeholder="'Ingrese su nombre'" :name="'name'">
                  </x-component-input>
                  <x-component-input :label="'Apellido'" :placeholder="'Ingrese su Apellido'" :name="'apellido'">
                  </x-component-input>
               </div>
               <div class="flex">
                  <x-component-input :label="'Email'" :placeholder="'Ingrese su email'" :name="'email'" :type="'email'">
                  </x-component-input>
                  <x-component-input-select :name="'role'" :label="'Rol'"
                     :options="['admin'=> 'Administrador','cliente'=> 'Cliente','vendedor'=> 'Vendedor']">
                  </x-component-input-select>
               </div>
               <div class="flex">
                  <x-component-input :label="'Imagen'" :placeholder="'Ingrese su imagen'" :name="'profile_photo_path'"
                     :type="'file'">
                  </x-component-input>
               </div>

               @if ($action == "Registrar")
               <div class="flex">
                  <x-component-input :label="'Contraseña'" :placeholder="'Ingrese su contraseña'" :name="'password'"
                     type="password">
                  </x-component-input>
                  <x-component-input :label="'Confirmar contraseña'" :placeholder="'Confirme su contraseña'"
                     :name="'password_confirmation'" type="password">
                  </x-component-input>
               </div>

               @endif
               </p>
            </div>
         </div>
      </x-component-modal>
   </form>
</div>