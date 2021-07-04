<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getAllDepartments()
    {
        try {
            $departments = $this->departmentRepository->getAllDepartments()->toArray();
            array_unshift($departments, ['id' => 0, 'name' => 'All']);

            return ResponseJson::responseArray($departments);
        } catch (\Exception $exception) {
            Log::error($exception);
            return ResponseJson::responseError($exception->getMessage());
        }
    }
}
