<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);
        $this->post($project->path() . '/tasks', ['body' => 'A task is added.']);
        $this->get($project->path())
            ->assertSee('A task is added.');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = auth()->user()->projects()->create(Project::factory()->raw());
        $task = $project->addTask('test task');
        $this->patch($task->path(),
            ['body' => 'changed', 'completed' => true]);
        $this->assertDatabaseHas('tasks', ['body' => 'changed', 'completed' => true]);
    }

    /** @test */
    public function guests_cannot_add_tasks_to_a_project()
    {
        $project = Project::factory()->create();
        $this->post($project->path() . '/tasks')->assertRedirect('/login');
    }

    /** @test */
    public function only_the_owner_of_project_may_add_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->post($project->path() . '/tasks', ['body' => 'A task is added.'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'A task is added']);
    }

    /** @test */
    public function only_the_owner_of_project_may_update_tasks()
    {
        $this->signIn();
        $project = Project::factory()->create();
        $task = $project->addTask('test task');
        $this->patch($task->path(), [
            'body' => 'A task is updated.',
            'completed' => true
        ])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'A task is added']);
    }


    /** @test */
    public function a_tasks_require_a_body()
    {
        $this->signIn();
        $project = Project::factory()->create(['owner_id' => auth()->id()]);
        $attributes = Task::factory()->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }


}
