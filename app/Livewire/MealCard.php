<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Meal;
use Livewire\WithPagination;

class MealCard extends Component
{
    
    public Meal $meal;
    public $cart;
    public $inCart = false;

    public function mount(){
        
    }

    public function boot(){
        $this->cart = session()->get('cart',[]);
    }

     #[On('mealSelected')]
    public function refreshCart(){
       
       $this->inCart = in_array($this->meal->id, $this->cart);
    }

    

    public function select()
    {
        $this->inCart = ! $this->inCart;

        $this->dispatch('mealSelected', mealId:$this->meal->id);
    }

    public function render()
    {
   
        return view('livewire.meal-card');
    }
}
