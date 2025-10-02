<div>
  <div class=" grid grid-cols-6 grid-rows-3 h-screen ">
      <div class=" col-span-1 row-span-3 flex flex-col border-r-2">
        <h2 class="font-inter text-2xl font-bold pl-2 mt-4">Quick Actions</h2>
       <div class="flex items-center p-2 mt-4 rounded-2xl transition hover:scale-105"> 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
          </svg>
          <a href="#" id="addUserButton" wire:click.prevent="$set('showAddUser', true)" class="font-inter text-lg pl-2" name="qaButton">Add Users</a>
        </div>

       <div class="flex items-center p-2 rounded-2xl transition  hover:scale-105"> 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
          </svg>
          <a href="#" id="EditUsersButton" wire:click.prevent="$set('showManageUsers', true)" class="font-inter text-lg pl-2" name="qaButton">Manage Users</a>
        </div>

       <div class="flex items-center p-2 rounded-2xl transition  hover:scale-105"> 
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
         </svg>
          <a href="#" id="AddMealButton"  class="font-inter text-lg pl-2" wire:click.prevent="$set('showAddMeal', true)"  name="qaButton">Add Meals</a>
        </div>

       <div class="flex items-center p-2 rounded-2xl transition  hover:scale-105"> 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
          </svg>
          <a href="#" id="EditMealsButton"  wire:click.prevent="$set('showManageMeals', true)" class="font-inter text-lg pl-2"  name="qaButton">Manage Meals</a>
        </div>
      </div>
      <div class="col-span-5 row-span-1 ml-5">
        <div class="grid grid-cols-4">
            <div class="col-span-1 mt-4 p-4">
                  <p class="font-inter text-2xl font-semibold opacity-75">Users Registered</p>
                  <h2 class="font-inter text-6xl font-bold text-green-400">{{ count($users) }}</h2>
            </div>
            <div class="col-span-2 mt-4 p-4">
                  <p class="font-inter text-2xl font-semibold opacity-75">Subscriptions Active</p>
                  <h2 class="font-inter text-6xl font-bold text-green-400">{{ count($subscriptions) }}</h2>
            </div>
            <div class="col-span-1 mt-4 p-4">
            </div>
        </div>
        <div class="col-span-5 row-span-1 mt-10">
          <h1 class="text-2xl font-inter font-bold mb-5">Popular Meals</h1>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
              @foreach($popularmeals as $meal)
                  <div class="card bg-base-100 shadow-xl rounded-2xl overflow-hidden">
                      <!-- Meal Image -->
                      <figure>
                          <img src="{{ asset('storage/' . $meal->image) }}"
                              alt="{{ $meal->meal_name }}"
                              class="h-48 w-full object-cover">
                      </figure>

                      <!-- Card Body -->
                      <div class="card-body">
                          <h2 class="card-title text-lg font-semibold">
                              {{ $meal->meal_name }}
                          </h2>
                          <p class="text-sm text-gray-500">
                              {{ Str::limit($meal->description, 80) }}
                          </p>

                          <div class="flex justify-between items-center mt-3">
                              <span class="badge badge-primary">
                                  {{ $meal->subscriptions_count }} Subscriptions
                              </span>
                              <span class="text-sm text-gray-400">
                                  Prep: {{ $meal->prep_time }} mins
                              </span>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>

        </div>
    </div>
  </div>
  <!-- Add User Modal -->
   @php
    $preferences=[
        ['id' => 'none', 'name' => 'None'],
        ['id' => 'vegan', 'name' => 'Vegan'],
        ['id' => 'vegetarian', 'name' => 'Vegetarian'],
        ['id' => 'gluten_free', 'name' => 'Gluten Free'],
    ]
   @endphp
<x-mary-modal wire:model="showAddUser" title="Add User">
    <form wire:submit.prevent="createUser" class="space-y-4">
        <x-mary-input label="Name" wire:model.defer="userForm.name"/>
        <x-mary-input label="Email" wire:model.defer="userForm.email"/>
        <x-mary-input label="Password" type="password" wire:model.defer="userForm.password"/>
        <x-mary-input label="Phone Number" wire:model.defer="userForm.phone_number"/>
        <x-mary-input label="Address" wire:model.defer="userForm.address"/>
        <x-mary-select label="Dietary Preference" :options="$preferences" 
                       wire:model.defer="userForm.dietary_preference"/>
        <x-mary-button color="primary" type="submit">Create User</x-mary-button>
    </form>
</x-mary-modal>

<!-- Manage Users Modal -->
<x-mary-modal wire:model="showManageUsers" title="Manage Users">
    <table class="table w-full">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="flex gap-2">
                        <x-mary-button color="secondary" size="sm" wire:click="editUser({{ $user->id }})">Edit</x-mary-button>
                        <x-mary-button color="danger" size="sm" wire:click="deleteUser({{ $user->id }})">Delete</x-mary-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-mary-modal>

<!-- Add Meal Modal -->
<x-mary-modal wire:model="showAddMeal" title="Add Meal">
    <form wire:submit.prevent="createMeal" class="space-y-4">
        <x-mary-input label="Meal Name" wire:model.defer="mealForm.meal_name"/>
        <x-mary-input label="Description" wire:model.defer="mealForm.description"/>
        <x-mary-input label="Prep Time (mins)" type="number" wire:model.defer="mealForm.prep_time"/>
        <p class="font-inter text-md font-semibold">Image</p>
        <input type="file" wire:model="mealForm.image" class="file-input file-input-bordered w-full mt-2" />
        @error('mealForm.image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


       {{-- Preview --}}
        @if ($mealForm['image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            {{-- If user just uploaded a new image --}}
            <img src="{{ $mealForm['image']->temporaryUrl() }}" class="w-32 h-32 object-cover mt-2 rounded-xl">
        @elseif(is_string($mealForm['image']) && $mealForm['image'] !== '')
            {{-- If editing and DB already has an image --}}
            <img src="{{ asset('storage/' . $mealForm['image']) }}" class="w-32 h-32 object-cover mt-2 rounded-xl">
        @endif
        <x-mary-checkbox label="Vegan" wire:model.defer="mealForm.is_vegan"/>
        <x-mary-checkbox label="Vegetarian" wire:model.defer="mealForm.is_vegetarian"/>
        <x-mary-checkbox label="Gluten Free" wire:model.defer="mealForm.is_gluten_free"/>
        <x-mary-button color="primary" type="submit">Create Meal</x-mary-button>
    </form>
</x-mary-modal>

<!-- Manage Meals Modal -->
<x-mary-modal wire:model="showManageMeals" title="Manage Meals">
    <table class="table w-full">
        <thead>
            <tr>
                <th>Image</th><th>Name</th><th>Prep Time</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td><img src="{{ asset('storage/' . $meal->image) }}" class="max-h-10 w-10 object-cover rounded-lg"></td>
                    <td>{{ $meal->meal_name }}</td>
                    <td>{{ $meal->prep_time }} mins</td>
                    <td class="flex gap-2">
                        <x-mary-button color="secondary" size="sm" wire:click="editMeal({{ $meal->id }})">Edit</x-mary-button>
                        <x-mary-button color="danger" size="sm" wire:click="deleteMeal({{ $meal->id }})">Delete</x-mary-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-mary-modal>
    <!--edit meal modal -->
<x-mary-modal wire:model="showEditMeal" title="Edit Meal">
    <form wire:submit.prevent="updateMeal" class="space-y-4">
        <x-mary-input label="Meal Name" wire:model.defer="mealForm.meal_name"/>
        <x-mary-input label="Description" wire:model.defer="mealForm.description"/>
        <x-mary-input label="Prep Time (mins)" type="number" wire:model.defer="mealForm.prep_time"/>
         <p class="font-inter text-md font-semibold">Image</p>
        <input type="file" wire:model="mealForm.image" class="file-input file-input-bordered w-full mt-2" />
        @error('mealForm.image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

     {{-- Preview --}}
        @if ($mealForm['image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            {{-- If user just uploaded a new image --}}
            <img src="{{ $mealForm['image']->temporaryUrl() }}" class="w-32 h-32 object-cover mt-2 rounded-xl">
        @elseif(is_string($mealForm['image']) && $mealForm['image'] !== '')
            {{-- If editing and DB already has an image --}}
            <img src="{{ asset('storage/' . $mealForm['image']) }}" class="w-32 h-32 object-cover mt-2 rounded-xl">
        @endif
        <x-mary-checkbox label="Vegan" wire:model.defer="mealForm.is_vegan"/>
        <x-mary-checkbox label="Vegetarian" wire:model.defer="mealForm.is_vegetarian"/>
        <x-mary-checkbox label="Gluten Free" wire:model.defer="mealForm.is_gluten_free"/>
        <x-mary-button color="primary" type="submit">Update Meal</x-mary-button>
    </form>
</x-mary-modal>
<!--edit user modal -->
<x-mary-modal wire:model="showEditUser" title="Edit User">
    <form wire:submit.prevent="updateUser" class="space-y-4">
        <x-mary-input label="Name" wire:model.defer="userForm.name"/>
        <x-mary-input label="Email" wire:model.defer="userForm.email"/>
        <x-mary-input label="Phone Number" wire:model.defer="userForm.phone_number"/>
        <x-mary-input label="Address" wire:model.defer="userForm.address"/>
        <x-mary-select label="Dietary Preference"
            :options="$preferences"
            wire:model.defer="userForm.dietary_preference"/>
        <x-mary-button color="primary" type="submit">Update User</x-mary-button>
    </form>
</x-mary-modal>

</div>
