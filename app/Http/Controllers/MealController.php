<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use MongoDB\BSON\ObjectId;

class MealController extends Controller
{
     public function index()
    {
        $meals = Meal::all(); 
        return view('meals', compact('meals'));
    }

        public function listMeals()
    {
        $meals = DB::connection('mongodb')
            ->table('meals')
            ->get();

        return response()->json($meals, 200);
    }

    // GET /api/meals/{id} (MongoDB)
    public function show($id)
    {
        try {
            $meal = DB::connection('mongodb')
                ->table('meals')
                ->where('_id', new ObjectId($id))
                ->first();

            if (!$meal) {
                return response()->json(['message' => 'Meal not found'], 404);
            }

            return response()->json($meal, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid meal ID'], 400);
        }
    }

    // POST /api/meals
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_name'      => 'required|string|max:255',
            'description'    => 'required|string',
            'prep_time'      => 'required|integer',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'is_vegan'       => 'boolean',
            'is_vegetarian'  => 'boolean',
            'is_gluten_free' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('meals', 'public');
        }

        $insertedId = DB::connection('mongodb')
            ->table('meals')
            ->insertGetId($validated);

        return response()->json([
            'id' => (string) $insertedId,
            'message' => 'Meal created successfully'
        ], 201);
    }

    // PUT /api/meals/{id}
    public function update(Request $request, $id)
    {
        try {
            $meal = DB::connection('mongodb')
                ->table('meals')
                ->where('_id', new ObjectId($id))
                ->first();

            if (!$meal) {
                return response()->json(['message' => 'Meal not found'], 404);
            }

            $validated = $request->validate([
                'meal_name'      => 'sometimes|string|max:255',
                'description'    => 'sometimes|string',
                'prep_time'      => 'sometimes|integer',
                'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
                'is_vegan'       => 'boolean',
                'is_vegetarian'  => 'boolean',
                'is_gluten_free' => 'boolean',
            ]);

            if ($request->hasFile('image')) {
                if (!empty($meal['image']) && Storage::disk('public')->exists($meal['image'])) {
                    Storage::disk('public')->delete($meal['image']);
                }
                $validated['image'] = $request->file('image')->store('meals', 'public');
            }

            DB::connection('mongodb')
                ->table('meals')
                ->where('_id', new ObjectId($id))
                ->update($validated);

            return response()->json(['message' => 'Meal updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid meal ID'], 400);
        }
    }

    // DELETE /api/meals/{id}
    public function destroy($id)
    {
        try {
            $meal = DB::connection('mongodb')
                ->table('meals')
                ->where('_id', new ObjectId($id))
                ->first();

            if (!$meal) {
                return response()->json(['message' => 'Meal not found'], 404);
            }


            DB::connection('mongodb')
                ->table('meals')
                ->where('_id', new ObjectId($id))
                ->delete();

            return response()->json(['message' => 'Meal deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid meal ID'], 400);
        }
    }
}

