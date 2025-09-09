<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subscription;

class CreateSubscription extends Component
{
    public $meals_per_week = 2;
    public $people_per_meal = 1;

    public $price_per_week;
    public function make(){
        
        $validated = $this->validate([
            'meals_per_week' => ['required', 'integer', 'min:1', 'max:21'],
            'people_per_meal' => ['required', 'integer', 'min:1', 'max:10'],
        ]);
        
         $existing = Subscription::where('user_id', auth()->id())
        ->where('status', 'active')
        ->first();

         if ($existing) {
        session()->flash('error', 'You already have an active subscription.');
        return;
    }

        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'status' => 'active',
            'start_date' => now(),
            'meals_per_week' => $validated['meals_per_week'],
            'people_per_meal' => $validated['people_per_meal'],
            'price_per_week' => $validated['meals_per_week'] * $validated['people_per_meal'] * 9.99, // Assuming a fixed price per meal
        ]);

        return redirect()->route('meals')->with('subscription_half_created', true);
    }
    public function render()
    {
        return view('livewire.create-subscription');
    }
}
