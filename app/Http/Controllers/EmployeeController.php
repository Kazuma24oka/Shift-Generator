<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    const RULES = [
        'name' => 'required',
        'preferred_working_days' => 'nullable',
        'preferred_days_off' => 'nullable',
        'min_working_days' => 'required',
        'store_id' => 'required',
        'preferred_store_id' => 'nullable',
        'incompatible_employee_id' => 'nullable',
    ];

    const MESSAGES = [
        'name.required' => '従業員名は必須です。',
        'min_working_days.required' => '最低出勤日数は必須です。',
        'store_id.required' => '所属店舗は必須です。',
    ];

    const REDIRECT_TO_INFORMATION = 'employees.information';

    public function index()
    {
        $employees = Employee::all();
        $stores = Store::all();
        return view('employees.information', compact('employees', 'stores'));
    }

    public function create()
    {
        $stores = Store::all();
        $employee = new Employee();
        return view('employees.create', compact('stores', 'employee'));
    }

    public function store(Request $request)
    {
        $request->validate(self::RULES, self::MESSAGES);

        Employee::create([
            'name' => $request->name,
            'preferred_working_days' => $request->preferred_working_days,
            'preferred_days_off' => $request->preferred_days_off,
            'min_working_days' => $request->min_working_days,
            'store_id' => $request->store_id,
            'preferred_store_id' => $request->preferred_store_id,
            'incompatible_employee_id' => $request->incompatible_employee_id,
        ]);

        return redirect()->route(self::REDIRECT_TO_INFORMATION)->with('success', '従業員情報が登録されました。');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $stores = Store::all();
        return view('employees.edit', compact('employee', 'stores'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'min_working_days' => 'required',
        'store_id' => 'required',
        'preferred_store_id' => 'nullable',
        'incompatible_employee_id' => 'nullable',
    ]);

    $employee = Employee::find($id);
    $employee->update([
        'name' => $request->name,
        'min_working_days' => $request->min_working_days,
        'store_id' => $request->store_id,
        'preferred_store_id' => $request->preferred_store_id,
        'incompatible_employee_id' => $request->incompatible_employee_id,
    ]);

    return redirect()->route('employees.information')->with('success', '従業員情報が更新されました。');
}
    
    public function updatePreferredWorkingDays(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update([
            'preferred_working_days' => $request->preferred_working_days,
        ]);
    
        return redirect()->route('employees.information')->with('success', '出勤希望日が更新されました。');
    }
    
    public function updatePreferredDaysOff(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update([
            'preferred_days_off' => $request->preferred_days_off,
        ]);
    
        return redirect()->route('employees.information')->with('success', '休み希望日が更新されました。');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.information')->with('success', '従業員情報が削除されました。');
    }
}