<div>
   <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
         <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow border-b border-gray-200 sm:rounded-lg">
               <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 ">
                  <div class="flex text-gray-500">
                     <select
                        class="form-select appearance-none block w-16 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        wire:model="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                     </select>
                     <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none mx-2"
                        placeholder="Ingrese el término de búsqueda" wire:model="search">
                     <select
                        class="form-select appearance-none block w-48 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        wire:model="user_role">
                        <option value="">Seleccione</option>
                        <option value="admin">Administrador</option>
                        <option value="vendedor">Vendedor</option>
                        <option value="cliente">Cliente</option>
                     </select>
                     <button wire:click="clear" class="ml-2">
                        <span class="fa fa-eraser"></span>
                     </button>
                  </div>
               </div>

               <button wire:click="showModal" type="button"
                  class="my-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-blue-100 px-3 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                  <div
                     class="mx-auto flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full  sm:mx-0 sm:h-6 sm:w-6">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-blue-900">
                        <path stroke-linecap="round" stroke-linejoin="round"
                           d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                     </svg>

                  </div>
               </button>

               <table class="min-w-full divide-y divide-gray-200">
                  <thead>
                     <tr>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           ID
                           <button wire:click="sortable('id')">
                              <span class="fa-solid fa{{$campo === 'id' ? $icon : '-circle'}}"></span>
                           </button>
                        </th>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Nombre
                           <button wire:click="sortable('name')">
                              <span class="fa-solid fa{{$campo === 'name' ? $icon : '-circle'}}"></span>
                           </button>
                        </th>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Apellido
                           <button wire:click="sortable('apellido')">
                              <span class="fa-solid fa{{$campo === 'apellido' ? $icon : '-circle'}}"></span>
                           </button>
                        </th>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Email
                           <button wire:click="sortable('email')">
                              <span class="fa-solid fa{{$campo === 'email' ? $icon : '-circle'}}"></span>
                           </button>
                        </th>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Role
                        </th>
                        <th scope="col"
                           class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Action
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($users as $user )
                     <tr class="border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ $user->name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ $user->r_lastname->apellido }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ $user->email }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ $user->rol }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           <a href="javascript:void(0)" class="text-indigo-600 hover:text-indigo-900"
                              wire:click="showModal({{ $user->id }})">Editar</a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                  {{ $users->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>