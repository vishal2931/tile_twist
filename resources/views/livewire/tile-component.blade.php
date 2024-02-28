<div>
    <div class="h-full w-full flex justify-center mt-16">
        <div class="">
            @foreach ($icon_names as $chunk => $icons)
                <div class="flex">
                    @foreach ($icons as $key => $icon)
                        <div class="h-32 w-32 border-black border-2 cursor-pointer p-4 relative"
                            wire:click='flipTile("{{ $icon }}",{{ $chunk }}, {{ $key }})'>
                            @if (empty($flipped_tiles[$key]) && empty($attempted_flipped_tiles[$key]))
                                <div class="w-full h-full bg-violet-700 absolute top-0 left-0"></div>
                            @endif
                            <img src="{{ asset('assets/images/' . $icon) }}" alt="">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('flip-different-tiles', () => {
            setTimeout(() => {
                $wire.reFlipDifferentTiles();
            }, 400);
        });
    </script>
@endscript