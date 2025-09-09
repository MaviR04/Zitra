
<div class="p-4 rounded-2xl w-64 shadow-sm hover:shadow-md transition cursor-pointer {{  $inCart ? 'bg-green-500' : '' }}" wire:click = "select"  >
    <img src="{{ asset('storage/'.$meal->image) }}" alt="{{ $meal->meal_name }}" class="w-full h-48 object-cover rounded-t-2xl ">
    
    <div class="mt-4">
        <h2 class="text-xl font-semibold">{{ $meal->meal_name }}</h2>
        
        <div class="flex items-center mt-2">
            <flux:icon.clock variant="micro" class="mr-2 size-5 text-gray-600" />
            <p>{{ $meal->prep_time }} mins</p>
        </div>

        <div class="mt-1 flex items-start">
            <div>
                @if ($meal->is_vegan || $meal->is_vegetarian || $meal->is_gluten_free)
                    <flux:icon.tag variant="micro" class="inline-block mr-2 size-6 text-gray-600" />
                @endif
            </div>
            
            <div class="flex gap-2 items-center flex-wrap">
                @if ($meal->is_vegan)
                    <span class="px-2 py-1 rounded-full text-sm font-medium bg-green-200 text-green-800">
                        Vegan
                    </span>
                @endif 

                @if ($meal->is_vegetarian)
                    <span class="px-2 py-1 rounded-full text-sm font-medium bg-lime-200 text-lime-800">
                        Vegetarian
                    </span>
                @endif 

                @if ($meal->is_gluten_free)
                    <span class="px-2 py-1 rounded-full text-sm font-medium bg-purple-200 text-purple-800">
                        Gluten Free
                    </span>
                @endif 
            </div>
        </div>

        <p class="text-gray-600 mt-3">{{ $meal->description }}</p>
    </div>
</div>