<x-layouts.app>
	<x-slot:title>Research - {{ config('app.name') }}</x-slot:title>
	
	<div class="max-w-7xl mx-auto px-6 py-12">
		<h1 class="text-3xl font-bold text-gray-800 mb-6">Research and Professional Activities</h1>
		<p class="text-gray-600 mb-8">Ever since the foundation of the Society, continuous attempts have been made to
		                              undertake projects. We have already accomplished some projects, and the work on a
		                              new project has just begun.</p>
		
		<div class="space-y-8">
			@foreach($researchProjects as $project)
				<div class="bg-white shadow-lg border border-gray-200 rounded-2xl p-6">
					<h2 class="text-xl font-semibold text-gray-800">{{ $project->title }}</h2>
					<div class="text-gray-600 mt-2 prose prose-lg">{!! Str::markdown($project->description) !!}</div>
				</div>
			@endforeach
		</div>
	</div>
</x-layouts.app>