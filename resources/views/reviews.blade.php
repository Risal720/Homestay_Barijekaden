<x-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Ulasan Pengguna ⭐</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reviews as $review)
                <div
                    style="border: 4px solid #38A169; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; background-color: white; border-radius: 10px; position: relative;">

                    <!-- Bentuk Circle untuk Rating -->
                    <div
                        style="width: 50px; height: 50px; background-color: #38A169; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; border-radius: 50%; position: absolute; top: -10px; left: -10px;">
                        ⭐ {{ $review->rating }}
                    </div>

                    <!-- Bentuk Rectangle untuk Nama -->
                    <div
                        style="width: 150px; padding: 10px; background-color: #4299E1; color: white; text-align: center; font-weight: bold; border-radius: 5px; margin-bottom: 10px;">
                        {{ $review->user->name }}
                    </div>

                    <!-- Bentuk Triangle untuk Komentar -->
                    <div
                        style="width: 0; height: 0; border-left: 75px solid transparent; border-right: 75px solid transparent; border-bottom: 100px solid #6A0DAD; text-align: center; padding-top: 30px; font-weight: bold;">
                        {{ $review->comment }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
