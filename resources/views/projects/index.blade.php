<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Projects
            </h2>
            <a href="/projects/create" class="bg-blue-600 rounded-full px-3 py-1 text-white text-sm font-semibold">Add
                new project</a>
        </div>
    </x-slot>

    <div class="lg:flex lg:flex-wrap lg:-mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </div>
</x-app-layout>
