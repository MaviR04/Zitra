<x-layout>
    <div class="min-h-screen w-full bg-gradient-to-br from-green-400 via-emerald-500 to-teal-400 relative overflow-hidden">
    <!-- Animated background blob -->
    <div class="absolute top-20 left-1/4 w-72 h-72 bg-lime-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute top-40 right-1/4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
    
    <!-- Hero Section -->
    <div class="relative z-10 container mx-auto px-4 pt-20 pb-12">
        <div class="text-center space-y-4">
            <h1 class="text-2xl md:text-6xl font-inter font-bold text-black drop-shadow-lg">Zitra</h1>
            <p class="text-2xl md:text-3xl text-black font-light">Meals from the heart, Without the hassle</p>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="relative z-10 container mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 max-w-7xl mx-auto">
            
            <!-- Card 1 -->
            <div class="bg-white rounded-3xl overflow-hidden transform hover:scale-105 transition duration-300 shadow-md">
                <div class="h-64 bg-gradient-to-br from-green-400 to-emerald-600 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <img src="/storage/beef_burrito.jpg" class="h-full w-full object-cover rounded-2xl" alt="" srcset="">
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <h3 class="text-3xl font-bold text-green-700">No more rummaging through fridges</h3>
                    <p class="text-gray-600 text-lg">Get everything you need to make fresh, delicious meals—delivered straight to your door. Skip the grocery store and skip the stress.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="h-64 bg-gradient-to-br from-yellow-400 to-orange-500 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <img src="/storage/chicken_alfredo_pasta.jpg" class="h-full w-full object-cover rounded-2xl" alt="" srcset="">
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <h3 class="text-3xl font-bold text-green-700">Dinner? Done.</h3>
                    <p class="text-gray-600 text-lg">Pre-measured ingredients, step-by-step recipes, and zero hassle. Cook like a pro without lifting a finger—well, almost.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="h-64 bg-gradient-to-br from-lime-400 to-green-500 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <img src="/storage/beef_stir_fry.jpg" class="h-full w-full object-cover rounded-2xl" alt="" srcset="">
                    </div> 
                </div>
                <div class="p-6 space-y-3">
                    <h3 class="text-3xl font-bold text-green-700">Your weeknight hero</h3>
                    <p class="text-gray-600 text-lg">Tired after work? We've got you. Quick, tasty meals designed to fit your schedule and your tastebuds.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative z-10 container mx-auto px-4 pb-16">
        <div class="text-center">
            <a href="subscription" class="inline-block bg-green-500 p-2 text-white text-3xl font-bold py-4 px-12 rounded-full shadow-2xl hover:shadow-3xl hover:scale-110 transform transition duration-300">
                Subscribe now
            </a>
        </div>
    </div>
</div>

</x-layout>