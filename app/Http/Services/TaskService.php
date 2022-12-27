<?php

namespace App\Http\Services;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepositoryEloquent;

class TaskService
{
  function __construct(private TaskRepositoryEloquent $repository)
  {
  }

  public function getAllByUser(int $userId)
  {
    return $this->repository->findWhere(['user_id' => $userId]);
  }

  public function create(CreateTaskRequest $request)
  {
    $dataStore = $request->validated();
    $dataStore['user_id'] = $request->user()->id;
    return $this->repository->create($dataStore);
  }

  public function findOne(int $id)
  {
    return $this->repository->find($id);
  }

  public function update(UpdateTaskRequest $request, int $id)
  {
    return $this->repository->update($request->validated(), $id);
  }

  public function delete($id)
  {
    return $this->repository->delete($id);
  }
}
