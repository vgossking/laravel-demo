<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class TaskController extends Controller
{
    function __construct(private TaskService $service)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $tasks = $this->service->getAllByUser($user->id)->toArray();
        return Inertia::render('Task/List', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Task/Create', ['isUpdate' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $this->service->create($request);
        return Redirect::route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $this->findAndCheckPermission($id);
        return Inertia::render('Task/Edit', ['isUpdate' => true, 'name' => $task->name, 'description' => $task->description, 'id' => $task->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $this->findAndCheckPermission($id);
        $this->service->update($request, $id);
        return Redirect::route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->findAndCheckPermission($id);

        $this->service->delete($id);
        return Redirect::route('task.index');
    }

    private function findAndCheckPermission(int $id)
    {
        $task = $this->service->findOne($id);
        if (!$task) {
            throw new NotFoundResourceException();
        }
        if (!Gate::allows('update-task', $task)) {
            abort(403);
        }
    }
}
