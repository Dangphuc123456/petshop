<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $employees = Employee::paginate($perPage);

        return view('admin.employee.index', compact('employees', 'perPage'));
    }

    public function destroy($employee_id)
    {
        $employees = Employee::findOrFail($employee_id);
        $employees->delete();

        return redirect()->route('admin.employee.index')->with('success', 'Xóa nhân viên thành công');
    }
}
