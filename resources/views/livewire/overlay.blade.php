<div>
@if(session('fls_locked'))

<div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center z-[9999]">

    <div class="bg-white p-6 rounded-xl w-[380px] shadow-xl">

        <h2 class="text-center font-bold text-lg mb-4">
            Session Locked
        </h2>

        <input
            type="password"
            wire:model="password"
            class="w-full border rounded p-2"
            placeholder="Enter password"
        />

        <button
            wire:click="unlock"
            class="w-full mt-4 bg-primary-600 text-white p-2 rounded"
        >
            Unlock
        </button>

    </div>

</div>

@endif
</div>