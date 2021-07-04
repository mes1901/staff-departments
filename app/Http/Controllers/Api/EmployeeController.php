<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees(Request $request)
    {
        try {
            $perPage = $request->get('perPage');
            $currentPage = $request->get('currentPage');
            $departmentId = $request->get('department');
            $offset = $perPage * ($currentPage - 1);

            if ($departmentId == 0) {
                $response['data'] = $this->employeeRepository->getEmployeesByCriteria($perPage, $offset)->toArray();
                $response['total_count'] = $records = $this->employeeRepository->getAllEmployeesCount();
            } else {
                $response['data'] = $this->employeeRepository->getEmployeesByDepartment($perPage, $offset,
                    $departmentId)->toArray();
                $response['total_count'] = $records = $this->employeeRepository->getEmployeesCountByDepartment($departmentId);
            }

            return ResponseJson::responseArray($response);
        } catch (\Exception $exception) {
            Log::error($exception);
            return ResponseJson::responseError($exception->getMessage());
        }
    }
}
