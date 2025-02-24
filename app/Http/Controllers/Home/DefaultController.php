<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Advanced;
use App\Models\Bonus;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\PaySalaryDetail;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function GetEmployeeSalary(Request $request)
    {
        // dd($request->all());
        $employee = Employee::findOrFail($request->employee_id);

        $overtime = Overtime::where('employee_id', $request->employee_id)
            ->where('month', date('F', strtotime('-1 month')))
            ->where('year', date('Y'))
            ->first();
        $bonus = Bonus::where('employee_id', $request->employee_id)
            ->where('month', date('F', strtotime('-1 month')))
            ->where('year', date('Y'))
            ->first();

        $pay_salary = PaySalaryDetail::where('employee_id', $request->employee_id)
            ->where('paid_month', date('F', strtotime('-1 month')))
            ->where('paid_year', date('Y'))
            ->where('paid_type', 'Salary')
            ->get();

        // check total salary
        if ($pay_salary->isEmpty()) {
            if ($employee != null && $overtime != null && $bonus != null) {
                $total_salary = $employee->salary + $overtime->ot_amount +  $bonus->bonus_amount;
            } elseif ($employee != null && $overtime != null && $bonus == null) {
                $total_salary = $employee->salary + $overtime->ot_amount;
            } elseif ($employee != null && $overtime == null && $bonus != null) {
                $total_salary = $employee->salary + $bonus->bonus_amount;
            } elseif ($employee != null && $overtime == null && $bonus == null) {
                $total_salary = $employee->salary;
            }
        } else {
            if ($employee != null && $overtime != null && $bonus != null) {
                $total_salary = $employee->salary + $overtime->ot_amount +  $bonus->bonus_amount - $pay_salary->sum('paid_amount');
            } elseif ($employee != null && $overtime != null && $bonus == null) {
                $total_salary = $employee->salary + $overtime->ot_amount - $pay_salary->sum('paid_amount');
            } elseif ($employee != null && $overtime == null && $bonus != null) {
                $total_salary = $employee->salary + $bonus->bonus_amount - $pay_salary->sum('paid_amount');
            } elseif ($employee != null && $overtime == null && $bonus == null) {
                $total_salary = $employee->salary - $pay_salary->sum('paid_amount');
            }
        }
        // dd($total_salary);
        return response()->json($total_salary);
    }


    public function GetEmployeeAdvance(Request $request)
    {
        $advanced = Advanced::where('employee_id', $request->employee_id)->get();
        if ($advanced->isEmpty()) {
            $advanced_amount = 0;
        } else {
            $advanced_amount = $advanced->sum('advance_amount');
        }
        return response()->json($advanced_amount);
    }
}
