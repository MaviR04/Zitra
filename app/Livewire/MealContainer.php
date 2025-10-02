<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Meal;
use Livewire\Attributes\On; 
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionFinished;


class MealContainer extends Component
{
    use WithPagination;

    public $filter = 'all';
    public $subscriptionStatus = 'guest';
    public $subscription;
    public $SelectedMeals = [];
    public $SubscriptionMealsNo = 0;
    public $cart = [];
    public $renderedcart = [];

    protected $listeners = ['mealSelected' => 'addMealToCart'];
    
    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $user = auth()->user();

        if (!$user) {
            $this->subscriptionStatus = 'guest';
            return;
        }

        $this->subscription = $user->subscription;

        if (!$this->subscription) {
            $this->subscriptionStatus = 'no_subscription';
        } elseif ($this->subscription->meals()->count() === 0) {
            $this->subscriptionStatus = 'subscription_incomplete';
            $this->SubscriptionMealsNo = $this->subscription->meals_per_week; 
        } else {
            $this->subscriptionStatus = 'subscription_complete';
        }
    }

    #[On('mealSelected')]
    public function addMealToCart($mealId)
        {
            $this->cart = session()->get('cart', []);

            if (in_array($mealId, $this->cart)) {
           
                $this->cart = array_diff($this->cart, [$mealId]);
            } else {
              
                if (count($this->cart) < $this->SubscriptionMealsNo) {
                    $this->cart[] = $mealId;
                }
            }   
            // Update session
            session()->put('cart', $this->cart);

            $this->dispatch('cart-updated');
        }
        
    public function saveCartToSubscription()
    {
        $user = auth()->user();
        $subscription = $user->subscription;
        if (! $subscription) {
            return session()->flash('error', 'You don’t have an active subscription.');
        }
        $mealIds = session()->get('cart', []);
        if (empty($mealIds)) {
            return session()->flash('error', 'Your cart is empty.');
        }
        $subscription->meals()->sync($mealIds);
        session()->forget('cart');
        Mail::to($user)->queue(new SubscriptionFinished());
        return redirect()->route('checkout_confirm')->with('success', 'Meals added to your subscription!');
    }


    public function toggleMealSelection($mealId)
    {
        if (in_array($mealId, $this->SelectedMeals)) {
            $this->SelectedMeals = array_diff($this->SelectedMeals, [$mealId]);
        } else {
            $this->SelectedMeals[] = $mealId;
        }
    }


    // Reset pagination when filter changes
    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function getMealsProperty()
    {
        $query = Meal::query();

        if ($this->filter === 'vegan') {
            $query->where('is_vegan', true);
        } elseif ($this->filter === 'vegetarian') {
            $query->where('is_vegetarian', true);
        } elseif ($this->filter === 'gluten_free') {
            $query->where('is_gluten_free', true);
        }

        return $query->paginate(8); // adjust per page
    }
    
 public function render()
    {
    
        foreach ($this->cart as $key => $value) {
            array_push($this->renderedcart, Meal::where('id',$value)->get('meal_name')); 
        }
        return view('livewire.meal-container', [
            'meals' => $this->meals,
        ]);
    }
}
