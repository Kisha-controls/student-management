@props(['eyebrow' => null, 'title', 'accent' => null])
<div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
    <div>
        @if ($eyebrow)<p class="eyebrow mb-2">{{ $eyebrow }}</p>@endif
        <h1 class="font-display text-4xl sm:text-5xl text-plum-800 leading-tight">{{ $title }} @if ($accent)<span class="accent">{{ $accent }}</span>@endif</h1>
    </div>
    <div class="flex items-center gap-2">{{ $slot }}</div>
</div>
