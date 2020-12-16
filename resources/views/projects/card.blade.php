<div class="card" style="height: 200px">
    <h1 class="text-xl mb-4 py-4 -ml-5 border-l-4 border-blue-300 pl-4">
        <a href="{{$project->path()}}">{{ $project->title }}</a>
    </h1>
    <div class="text-gray-400">
        {{ \Illuminate\Support\Str::limit($project->description, 100) }}
    </div>
</div>

