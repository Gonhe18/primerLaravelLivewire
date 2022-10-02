<div class="mx-1 my-2">
   <div>
      <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
      <div class="relative mt-1 rounded-md shadow-sm">
         <select wire:model="{{$name}}"
            class="form-select appearance-none block w-48 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option value="">Seleccione</option>
            @foreach ($options as $key => $option)
            <option value="{{$key}}">{{$option}}</option>
            @endforeach
         </select>
      </div>
   </div>
</div>