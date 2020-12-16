<x-app-layout>
    <x-slot name="header">
        <p class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="/projects">My Project</a> / {{ $project->title }}
        </p>
    </x-slot>
    <main>
        <div class="lg:flex lg:-mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="font-normal text-lg text-gray mb-3 mb-3">Tasks</h2>
                    @forelse($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex items-center">
                                    <input class="w-full font-semibold rounded border-none mr-2 {{ $task->completed ? 'text-gray-400' : '' }}" type="text" value="{{ $task->body }}" name="body" />
                                    <input {{ $task->completed ? 'checked' : '' }} type="checkbox" name="completed" class="rounded" onchange="this.form.submit()">
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="card mb-3">No tasks yet.</div>
                    @endforelse
                    <form action="{{$project->path() . '/tasks'}}" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <input class="w-full border-none focus:border-none focus:border-gray-100" type="text" placeholder="Add a new task." name="body"/>
                        </div>
                    </form>
                </div>
                <div class="">
                    <h2 class="font-normal text-lg text-gray mb-3 mb-3">General notes</h2>
                    <textarea class="card w-full" style="min-height: 200px"></textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>

</x-app-layout>
