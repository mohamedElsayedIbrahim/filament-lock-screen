<x-filament::page>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-md bg-white shadow rounded-xl p-6">

            <h2 class="text-center text-xl font-bold mb-2">
                Session Locked
            </h2>

            <p class="text-center text-gray-500 mb-6">
                Enter password to continue
            </p>

            <form wire:submit.prevent="unlock">

                <x-filament::input
                    type="password"
                    wire:model="password"
                    placeholder="Password"
                />

                <button class="w-full mt-4 bg-primary-600 text-white py-2 rounded-lg">
                    Unlock
                </button>

            </form>

        </div>

    </div>
</x-filament::page>