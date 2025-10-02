<div>
   <div>
    <form wire:submit="make" class="space-y-6 max-w-lg mx-auto  ">
        {{-- Meals per week --}}
        <h1 class="font-inter text-2xl font-bold text-green-500">No Stress Healthy Meals, A couple of Clicks away</h1>
              <div class="flex flex-col">
                    <label class="text-lg font-medium font-inter">Meals Per Week</label>
                    <x-mary-group class="text-lg !mt-2" for="meals_per_week" :options="[
                                ['name' => '2 meals', 'id' => 2],
                                ['name' => '4 meals', 'id' => 3],
                                ['name' => '6 meals', 'id' => 6],
                                ['name' => '8 meals', 'id' => 8],
                            ]"
                            id="meals_per_week"
                            wire:model.live="meals_per_week"
                         
                            >
            
                        @error('meals_per_week') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </x-mary-group>
            
                    {{-- People per meal --}}
                    <div class="mt-4">
                        <h1 class="text-lg font-medium font-inter ">People Per Week</label>
                        <x-mary-group 
                        class="text-lg !mt-2"
                        id="people_per_meal"
                        wire:model.live="people_per_meal"
                        for="people_per_meal" 
                        :options="[
                                    ['name' => '1 person', 'id' => 1],
                                    ['name' => '2 people', 'id' => 2],
                                    ['name' => '4 people', 'id' => 4],
                                ]">
                            
                            @error('people_per_meal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </x-mary-group>
                        
                    </div>
                     @if(session()->has('error'))
                        <div class="text-red-500 text-sm bg-red-200 p-2">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                     <div class="mt-20">
                    @if ($meals_per_week && $people_per_meal)
                    <h1 class="text-lg font-inter "> {{ $meals_per_week  }} meals for {{ $people_per_meal }} people per week</h1>
                    <h1 class="text-lg font-inter "> {{ $meals_per_week * $people_per_meal }} servings at <span class="font-bold texl-lg">$9.99</span> a serving</h1>
                    <h1 class="text-lg font-inter my-5 font-medium "> Weekly Price: <span class="font-bold">${{ $meals_per_week * $people_per_meal * 9.99 }}</span></h1>
                @endif
                        <x-mary-button type="submit" color="primary" class="w-full">
                            Create Subscription
                        </x-mary-button>
                </div>
              </div>
               


        
    </form>
</div>

</div>
