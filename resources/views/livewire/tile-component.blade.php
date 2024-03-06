<div>
    <div class="headings mt-5">
        <h2 class="text-4xl text-center font-semibold font-satisfy text-white">{{ config('app.name') }}</h2>
        <h2 class="text-3xl text-center font-semibold font-satisfy text-white mt-8">{{ __('Points :') }} <span
                class="text-yellow-400 text-4xl">{{ $points }}</span></h2>
    </div>
    <div class="h-full w-full flex justify-center mt-5">
        @if (!$is_win && !$is_lost)
            <div class="">
                @foreach ($icon_names as $chunk => $icons)
                    <div class="flex">
                        @foreach ($icons as $key => $icon)
                            <div class="sm:size-14 md:size-28 lg:size-28 cursor-pointer p-4 relative m-1 bg-gradient-to-r from-lime-400 to-lime-500 rounded-2xl"
                                wire:click='flipTile("{{ $icon }}",{{ $chunk }}, {{ $key }})'>
                                @if (empty($flipped_tiles[$key]) && empty($attempted_flipped_tiles[$key]))
                                    <div
                                        class="w-full h-full bg-gradient-to-r from-emerald-400 to-cyan-400 absolute top-0 left-0 rounded-2xl">
                                    </div>
                                @endif
                                <img src="{{ asset('assets/images/' . $icon) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @elseif($is_win)
            <div>
                <h4 class="text-6xl my-36 text-yellow-300 animate-bounce"> You Win 🚀</h4>
            </div>
        @elseif($is_lost)
            <div>
                <h4 class="text-6xl my-36 text-red-500 animate-pulse"> You Lost 😟</h4>
            </div>
        @endif
    </div>
    <div class="text-center mt-8">
        @if (!$is_win & !$is_lost)
            <span class="block mb-3 font-satisfy text-white text-5xl" wire:ignore><span id="minutes"></span> : <span
                    id="seconds"></span></span>
        @endif
        <button class="rounded-full bg-yellow-300" type="button" title="{{ __('Restart Game') }}"
            wire:click='resetTiles' wire:loading.class='animate-spin' wire:target='resetTiles'
            wire:loading.attr="disabled"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64"
                height="64" fill="currentColor">
                <path
                    d="M5.46257 4.43262C7.21556 2.91688 9.5007 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C9.84982 4 7.89777 4.84827 6.46023 6.22842L5.46257 4.43262ZM18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 9.86386 2.66979 7.88416 3.8108 6.25944L7 12H4C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z">
                </path>
            </svg></button>
        <a href="{{ route('tiles.level') }}"
            class="h-14 w-56 text-white rounded-xl border-4 mx-auto mt-4
            border-yellow-300 px-10 py-2 block text-2xl font-satisfy cursor-pointer hover:border-black hover:bg-yellow-300 hover:text-black transition duration-150">{{ __('Change Level') }}</a>
        <div class="flex items-center justify-center gap-16">
        </div>
    </div>
</div>
@script
    <script>
        let container = document.querySelector('.fireworks');
        const fireworks = new Fireworks.default(container);
        let seconds = $wire.duration * 60;
        let timer = new easytimer.Timer();
        timer.start({
            countdown: true,
            precision: 'seconds',
            startValues: {
                seconds: seconds
            }
        });

        timer.addEventListener('secondsUpdated', function(e) {
            document.getElementById('minutes').innerHTML = timer.getTimeValues().minutes < 10 ? '0' + timer
                .getTimeValues().minutes : timer.getTimeValues().minutes;
            document.getElementById('seconds').innerHTML = timer.getTimeValues().seconds < 10 ? '0' + timer
                .getTimeValues().seconds : timer.getTimeValues().seconds;
        });
        timer.addEventListener('targetAchieved', function(e) {
            $wire.lostGame();
        });

        $wire.on('flip-different-tiles', () => {
            setTimeout(() => {
                $wire.reFlipDifferentTiles();
            }, 400);
        });

        $wire.on('reset-tiles', () => {
            timer.reset();
            fireworks.stop();
        });

        $wire.on('win-the-game', () => {
            timer.stop();
            fireworks.start();
        });
    </script>
@endscript
