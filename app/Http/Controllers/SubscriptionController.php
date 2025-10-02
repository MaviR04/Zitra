<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;


class SubscriptionController extends Controller
{
    public function index(){
        return view('subscription');
    }

     public function show($id)
    {
        $subscription = DB::connection('mongodb')
            ->table('subscriptions')
            ->where('_id', new ObjectId($id))
            ->first();

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        return response()->json($subscription);
    }


  public function getMeals($id)
{
    
    $subscription = DB::connection('mongodb')
        ->table('subscriptions')
        ->where('_id', new \MongoDB\BSON\ObjectId($id))
        ->first();

    if (!$subscription) {
        return response()->json(['message' => 'Subscription not found'], 404);
    }

    // 2. Extract meal IDs (make sure they are ObjectIds)
    $mealIds = collect($subscription->meal_ids ?? [])
        ->map(fn($mealId) => new \MongoDB\BSON\ObjectId($mealId))
        ->toArray();

    if (empty($mealIds)) {
        return response()->json(['message' => 'No meals found for this subscription']);
    }

    // 3. Fetch meals
    $meals = DB::connection('mongodb')
        ->table('meals')
        ->whereIn('_id', $mealIds)
        ->get();

    return response()->json($meals);
}


    /**
     * Update a subscription
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'status', 'start_date', 'meals_per_week', 'people_per_meal', 'price_per_week'
        ]);

        $updated = DB::connection('mongodb')
            ->table('subscriptions')
            ->where('_id', new ObjectId($id))
            ->update($data);

        return response()->json(['updated' => $updated > 0]);
    }

    /**
     * Delete a subscription
     */
    public function destroy($id)
    {
        $deleted = DB::connection('mongodb')
            ->table('subscriptions')
            ->where('_id', new ObjectId($id))
            ->delete();

        return response()->json(['deleted' => $deleted > 0]);
    }
}
