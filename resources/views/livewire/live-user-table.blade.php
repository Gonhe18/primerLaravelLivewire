<div>
   <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
         <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow border-b border-gray-200 sm:rounded-lg">
               <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                  <div class="flex text-gray-500 ">
                     <select
                        class="form-select appearance-none block w-16 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        wire:model="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                     </select>
                     <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none ml-6"
                        placeholder="Ingrese el término de búsqueda" wire:model="search">
                     <button wire:click="clear" class="ml-6">
                        <span class="fa fa-eraser"></span>
                     </button>
                  </div>
               </div>

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
                           Name
                           <button wire:click="sortable('name')">
                              <span class="fa-solid fa{{$campo === 'name' ? $icon : '-circle'}}"></span>
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
                           {{ $user->email }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           Admin
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           Edit
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