{{-- Success / error messages and validation summary --}}
@if (session('success'))
    <div class="mb-4 flex items-start gap-3 rounded-xl border border-[#b9e3dd] bg-[#e8f6f3] px-4 py-3 text-sm text-[#17786d] animate-fade-in">
        <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i><span>{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="mb-4 flex items-start gap-3 rounded-xl border border-[#f0c9cf] bg-[#fdeef0] px-4 py-3 text-sm text-[#b4233a] animate-fade-in">
        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i><span>{{ session('error') }}</span>
    </div>
@endif
@if ($errors->any() && ! request()->routeIs('login', 'register'))
    <div class="mb-4 rounded-xl border border-[#f0c9cf] bg-[#fdeef0] px-4 py-3 text-sm text-[#b4233a]">
        <p class="font-semibold mb-1">Please fix the following:</p>
        <ul class="list-disc pl-5 space-y-0.5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
