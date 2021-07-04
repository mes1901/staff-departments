<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployeesByCriteria(int $limit, int $offset)
    {
        return Employee::leftJoin('departments', function ($join) {
                $join->on('departments.id', '=', 'employees.department_id');
            })
            ->offset($offset)
            ->limit($limit)
            ->get([
                'employees.*',
                'departments.name as department',
            ]);
    }

    public function getAllEmployeesCount()
    {
        return Employee::all()->count();
    }

    public function getEmployeesByDepartment(int $limit, int $offset, int $departmentId)
    {
        return Employee::where('employees.department_id', $departmentId)
            ->leftJoin('departments', function ($join) {
                $join->on('departments.id', '=', 'employees.department_id');
            })
            ->offset($offset)
            ->limit($limit)
            ->get([
                'employees.*',
                'departments.name as department',
            ]);
    }

    public function getEmployeesCountByDepartment(int $departmentId)
    {
        return Employee::where('department_id', $departmentId)
            ->count();
    }
}