<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Project
            </h2>
            <a href="/projects" class="bg-blue-600 rounded-full px-3 py-1 text-white text-sm font-semibold">
                View all Projects
            </a>
        </div>
    </x-slot>

    <div class="card flex flex-wrap mx-1 lg:mx-0">
        <form method="POST" action="{{ url('/projects')}}" class="w-full" style="padding-top: 40px">
            @csrf
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Create a Project</h1>
            <div>
                <x-label for="email" :value="__('Title')"/>
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                         autofocus></x-input>
            </div>

            <div>
                <label class="label" for="description">Description</label>
                <textarea name="description"
                          class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </textarea>
            </div>
            <button type="submit" class="bg-blue-600 rounded-full px-3 py-1 text-white text-sm font-semibold mt-2">Create Project</button>
        </form>
    </div>
</x-app-layout>

