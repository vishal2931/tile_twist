<div>
    <div class="headings mt-5">
        <h2 class="text-4xl text-center font-semibold font-satisfy text-white">{{ config('app.name') }}</h2>
        <h2 class="text-3xl text-center font-semibold font-satisfy text-white mt-8">{{ __('Select Your Level') }}</h2>
    </div>
    <div class="mt-5 flex flex-col justify-center items-center space-y-10">
        @foreach ($levels as $level)
            <div>
                <a href="#" class="text-white rounded-xl border-4 border-yellow-300 px-20 py-6 block text-2xl font-satisfy cursor-pointer hover:border-black hover:bg-yellow-300 hover:text-black transition duration-150" wire:click='selectLevel("{{ $level }}")'>{{ Str::title($level) }}</a>
            </div>
        @endforeach
    </div>
</div>
