<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function list(Request $rquest)
    {
        $tasks = $this->taskRepository->all();
        return response()->json([
            'tasks' => $tasks
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->taskRepository->store($request->all());
            DB::commit();

            $msg = 'agregado';
            if (!empty($request['id'])) {
                $msg = 'modificado';
            }

            return response()->json(['code' => 200, 'message' => 'Registro ' . $msg . ' correctamente', 'data' => $data]);
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['code' => 500, 'message' => $th->getMessage()], 500);
        }
    }
}
