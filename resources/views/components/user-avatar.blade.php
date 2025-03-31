@if($avatar)
	<img src="{{ $avatar }}" alt="User Avatar" class="w-10 h-10 rounded-full object-cover">
@else
	<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500 text-white">
        {{ substr(auth()->user()->name, 0, 1) }}
    </span>
@endif
