<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Meal;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class AdminPanel extends Component
{   
    use WithFileUploads;
    public $subscriptions;
    public $users;
    public $meals;
    public $popularmeals;
    public $showAddUser = false;
    public $showManageUsers = false;
    public $showAddMeal = false;
    public $showManageMeals = false;
    public $showEditUser = false;
    public $showEditMeal = false;
    

    public $userForm = [];
    public $mealForm = [
        'meal_name' => '',
        'description' => '',
        'prep_time' => '',
        'is_vegan' => false,
        'is_vegetarian' => false,
        'is_gluten_free' => false,
        'image' => null, 
    ];

    
    public $editingUserId;
    public $editingMealId;

    protected $rules = [
        // Users
        'userForm.name' => 'required|string|max:255',
        'userForm.email' => 'required|email|unique:users,email',
        'userForm.password' => 'nullable|string|min:6',
        'userForm.phone_number' => 'required|string|max:20',
        'userForm.address' => 'required|string|max:255',
        'userForm.dietary_preference' => 'required|string|max:50',

        // Meals
        'mealForm.meal_name' => 'required|string|max:255',
        'mealForm.description' => 'required|string',
        'mealForm.prep_time' => 'required|integer|min:1',
        'mealForm.is_vegan' => 'boolean',
        'mealForm.is_vegetarian' => 'boolean',
        'mealForm.is_gluten_free' => 'boolean',
        'mealForm.image' => 'nullable|image|max:2048'
    ];

    protected $validationAttributes = [
        'userForm.name' => 'Name',
        'userForm.email' => 'Email',
        'userForm.password' => 'Password',
        'userForm.phone_number' => 'Phone Number',
        'userForm.address' => 'Address',
        'userForm.dietary_preference' => 'Dietary Preference',
        'mealForm.meal_name' => 'Meal Name',
        'mealForm.description' => 'Description',
        'mealForm.prep_time' => 'Prep Time',
        'mealForm.image' => 'Image',
    ];

      public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // ✅ All subscriptions
        $this->subscriptions = Subscription::with('user', 'meals')->get();

        // ✅ All users
        $this->users = User::with('subscription')->get();

        // ✅ All meals
        $this->meals = Meal::withCount('subscriptions')->get();

        // ✅ Popular meals (top 5 by subscription count)
        $this->popularmeals = Meal::withCount('subscriptions')
            ->orderByDesc('subscriptions_count')
            ->take(5)
            ->get();
    }
    

    // ========== USER CRUD ==========
    public function createUser()
    {
        $this->validate([
        'userForm.name' => 'required|string|max:255',
        'userForm.email' => 'required|email|unique:users,email',
        'userForm.password' => 'required|string|min:6',
        ]);
        
        User::create([
            'name' => $this->userForm['name'],
            'email' => $this->userForm['email'],
            'password' => Hash::make($this->userForm['password']),
            'phone_number' => $this->userForm['phone_number'] ?? null,
            'address' => $this->userForm['address'] ?? null,
            'dietary_preference' => $this->userForm['dietary_preference'] ?? "none",
        ]);

        $this->reset('userForm');
        $this->showAddUser = false;
        $this->loadData();
    } 

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        $this->loadData();
    }

    
    public function updateUser()
    {
        $this->validate([
            'userForm.name' => 'required|string|max:255',
            'userForm.email' => 'required|email|unique:users,email,' . $this->editingUserId,
        ]);

        $user = User::findOrFail($this->editingUserId);
        $user->update(collect($this->userForm)->except('password')->toArray());

        $this->reset(['userForm', 'editingUserId', 'showEditUser']);
        $this->loadData();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->editingUserId = $id;
        $this->userForm = $user->toArray();
        unset($this->userForm['password']); // don’t preload password
        $this->showEditUser = true;
    }

    // ========== MEAL CRUD ==========
    public function createMeal()
    {
        $this->validate([
        'mealForm.meal_name' => 'required|string|max:255',
        'mealForm.description' => 'required|string',
        'mealForm.prep_time' => 'required|integer|min:1',
        ]);

        $mealData = collect($this->mealForm)->except('image')->toArray();

        if ($this->mealForm['image']) {
        $mealData['image'] = $this->mealForm['image']->store('meals', 'public');
    }

        Meal::create($mealData);

        $this->reset('mealForm');
        $this->showAddMeal = false;
        $this->loadData();
    }

    public function deleteMeal($id)
    {
        Meal::findOrFail($id)->delete();
        $this->loadData();
    }

    public function editMeal($id)
    {       
        $meal = Meal::findOrFail($id);
        $this->editingMealId = $id;
        $this->mealForm = $meal->toArray();
        $this->showEditMeal = true;
    }

    public function updateMeal()
{
    $this->validate([
        'mealForm.meal_name' => 'required|string|max:255',
        'mealForm.description' => 'required|string',
        'mealForm.prep_time' => 'required|integer|min:1',
    ]);

    $meal = Meal::findOrFail($this->editingMealId);
     $mealData = collect($this->mealForm)->except('image')->toArray();

    // If new image uploaded, replace old one
    if ($this->mealForm['image']) {
        $mealData['image'] = $this->mealForm['image']->store('meals', 'public');
    }
    $meal->update($mealData);

    $this->reset(['mealForm', 'editingMealId', 'showEditMeal']);
    $this->loadData();
}

    public function render()
    {
        return view('livewire.admin-panel');
    }
}
