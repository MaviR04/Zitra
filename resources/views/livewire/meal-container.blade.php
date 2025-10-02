<div>

    @if ($subscriptionStatus === 'guest')
    <p>Please log in to subscribe and view personalized meals.</p>

    @elseif ($subscriptionStatus === 'no_subscription')
    <p class=" font-inter">You don’t have a subscription yet. <a class=" underline hover:text-blue-400" href="{{ route('subscription') }}">Start one here</a>.</p>

    @elseif ($subscriptionStatus === 'subscription_incomplete')
        @if (count($cart) === 0)
            <p class="font-inter mb-2 text-md">Your subscription is created but you haven’t selected meals yet. Choose from below:</p>
        @elseif(count($cart) === $SubscriptionMealsNo)
        <div class="flex justify-between items-center" wire:click="saveCartToSubscription">
            <span class="font-inter font-semibold text-lg">{{ count($cart) }}/{{ $SubscriptionMealsNo }} Meals Selected</span>
            <button class="btn  btn-primary">Confirm Meals and Checkout</button>
        </div>
            
        @else
            <span class="font-inter font-semibold text-lg">{{ count($cart) }}/{{ $SubscriptionMealsNo }} Meals Selected</span>
        @endif
    @endif
    <!-- Filter Buttons -->
    <div class="flex gap-3 mb-6 justify-center ">
        <button wire:click="setFilter('all')" 
            class="px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-500 hover:text-white transition
            {{ $filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
            All
        </button>

        <button wire:click="setFilter('vegan')" 
            class="px-4 py-2 rounded-full text-sm font-medium hover:bg-green-500 hover:text-white transition
            {{ $filter === 'vegan' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-800' }}">
            Vegan
        </button>

        <button wire:click="setFilter('vegetarian')" 
            class="px-4 py-2 rounded-full text-sm font-medium hover:bg-lime-500 hover:text-white transition
            {{ $filter === 'vegetarian' ? 'bg-lime-500 text-white' : 'bg-gray-200 text-gray-800' }}">
            Vegetarian
        </button>

        <button wire:click="setFilter('gluten_free')" 
            class="px-4 py-2 rounded-full text-sm font-medium hover:bg-purple-500 hover:text-white transition
            {{ $filter === 'gluten_free' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-800' }}">
            Gluten Free
        </button>
    </div>

    <!-- Meal Cards -->
    <div class="flex flex-wrap gap-6 justify-evenly  mt-6">
        @forelse ($this->meals as $meal)
            <livewire:meal-card :meal="$meal" :key="$meal->id" :in-cart="in_array($meal->id, $cart)"  />
        @empty
            <p class="text-gray-500">No meals found for this filter.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $this->meals->links() }}
    </div>
</div>
