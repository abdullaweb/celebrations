<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Advanced;
use App\Models\Bonus;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Overtime;
use App\Models\PaySalary;
use App\Models\PaySalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;


class SalaryController extends Controller
{
    public function DueSalary()
    {
        $employees = Employee::OrderBy('name', 'asc')->get();
        return view('admin.salary.due_salary', compact('employees'));
    }
    public function SalaryOverview()
    {


        $basicSalary = Employee::sum('salary');
        $requestMonth = $this->requestMonth();

        if ($requestMonth == 'December') {
            $overtimeAmount = Overtime::where('month', $requestMonth)->where('year', date('Y', strtotime('-1 year')))->sum('ot_amount');
            $bonusAmount = Bonus::where('month', $requestMonth)->where('year', date('Y', strtotime('-1 year')))->sum('bonus_amount');
            $advanceAmount = Advanced::where('month', $requestMonth)->where('year', date('Y', strtotime('-1 year')))->sum('advance_amount');
            $paySalary = PaySalaryDetail::where('paid_month', $requestMonth)->where('paid_year', date('Y', strtotime('-1 year')))->sum('paid_amount');
        } else {
            $overtimeAmount = Overtime::where('month', $requestMonth)->where('year', date('Y'))->sum('ot_amount');
            $bonusAmount = Bonus::where('month', $requestMonth)->where('year', date('Y'))->sum('bonus_amount');
            $advanceAmount = Advanced::where('month', $requestMonth)->where('year', date('Y'))->sum('advance_amount');
            $paySalary = PaySalaryDetail::where('paid_month', $requestMonth)->where('paid_year', date('Y'))->sum('paid_amount');
        }

        $grossTotal = $basicSalary + $overtimeAmount + $bonusAmount;
        $dueAmount = $grossTotal - $paySalary - $advanceAmount;
        return view('admin.salary.salary_overview', compact('grossTotal', 'requestMonth', 'basicSalary', 'overtimeAmount', 'bonusAmount', 'advanceAmount', 'paySalary', 'dueAmount'));
    }

    public function requestMonth()
    {
        $firstOfThisMonth = date('Y-m') . '-01';
        $requestMonth = date('F', strtotime($firstOfThisMonth . ' -1 month'));
        return $requestMonth;
    }

    public function PaySalary()
    {
        $year = $this->checkRequestYear();
        $employees = Employee::latest()->get();
        $firstOfThisMonth = date('Y-m') . '-01';
        $requestMonth = $this->requestMonth();
        return view('admin.salary.pay_salary.pay_salary', compact('employees', 'year', 'requestMonth'));
    }

    public function PaySalaryNow($id)
    {
        // check request year
        $year = $this->checkRequestYear();
        $employee = Employee::findOrFail($id);

        $requestMonth = $this->requestMonth();
        $advanced = Advanced::where('employee_id', $id)
            ->where('month', $requestMonth)
            ->where('year', $year)
            ->get();

        $bonus = Bonus::where('employee_id', $employee->id)
            ->where('month', $requestMonth)
            ->where('year', $year)
            ->first();

        if ($advanced) {
            $advanced_amount = $advanced->sum('advance_amount');
        } else {
            $advanced_amount = 0;
        }

        if ($bonus == null) {
            $bonus_amount = 0;
        } else {
            $bonus_amount = $bonus->bonus_amount;
        }


        $overtime = Overtime::where('employee_id', $employee->id)
            ->where('month', $requestMonth)
            ->where('year', $year)
            ->get();



        $pay_salary = PaySalaryDetail::where('employee_id', $employee->id)
            ->where('paid_month', $requestMonth)
            ->where('paid_year', $year)
            ->get();


        $total_salary = $employee->salary + $overtime->sum('ot_amount') + $bonus_amount;
        $due_salary = $total_salary - $advanced_amount - $pay_salary->sum('paid_amount');

        return view('admin.salary.pay_salary.pay_salary_add', compact('employee', 'total_salary', 'advanced_amount','due_salary'));
    }

    public function StorePaySalary(Request $request)
    {
        // check request year
        $year = $this->checkRequestYear();
        $requestMonth = $this->requestMonth();
        $employee_id = $request->employee_id;
        $employee = Employee::findOrFail($employee_id);

        $pay_salary_table = PaySalary::where('employee_id', $employee_id)
            ->where('paid_month', $requestMonth)
            ->where('paid_year', $year)
            ->get();


        if ($request->paid_amount > $request->due_total) {
            $notification = array(
                'message' => 'Paid Amount must be less than or equal to  Due Salary',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {


            $paid_salary_details = new PaySalaryDetail();
            $paid_salary_details->employee_id = $employee_id;

            $paid_salary_details->paid_month = $requestMonth;
            $paid_salary_details->paid_year = $year;
            $paid_salary_details->note = $request->note;
            $paid_salary_details->paid_date = $request->date;
            $paid_salary_details->paid_amount = $request->paid_amount;
            $paid_salary_details->save();

            // save data to expense
            $expense = new Expense();
            $expense->head = 'Salary';
            $expense->description = 'Paid to ' . $employee->name;
            $expense->date = $request->date;
            $expense->created_at = Carbon::now();
            $expense->amount = $request->paid_amount;
            $expense->save();


            if ($pay_salary_table->isEmpty()) {
                $paid_salary = new PaySalary();
                $paid_salary->employee_id = $employee_id;
                $paid_salary->paid_month = $requestMonth;
                $paid_salary->paid_year = $year;
                $paid_salary->created_at = Carbon::now();
                $paid_salary->save();
            }

            $notification = array(
                'message' => 'Paid Amount Added Successfully!',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('pay.salary')->with($notification);
    }


    // add salary by employee
    public function AddSalary()
    {
        $employees = Employee::latest()->get();
        return view('admin.salary.pay_salary.add_salary', compact('employees'));
    }

    // all overtime method
    public function AllOvertime()
    {
        $allOvertime = Overtime::latest()->get();
        return view('admin.salary.overtime.all_overtime', compact('allOvertime'));
    }

    public function AddOvertime()
    {
        $years = [];
        $currentYear = date('Y');
        for ($year = 2000; $year <= $currentYear; $year++) {
            $years[$year] = $year;
        }
        $employees = Employee::orderBy('name', 'desc')->get();
        return view('admin.salary.overtime.add_overtime', compact('employees', 'years'));
    }
    public function StoreOvertime(Request $request)
    {

        $month = Carbon::parse($request->month)->format('m');
        $numberOfDay = Carbon::now()->month($month)->year($request->year)->daysInMonth;
        $employeeSalary = Employee::where('id', $request->employee_id)->first()['salary'];

        $ot_hour_amount =  ($employeeSalary / $numberOfDay) / 8;
        $ot_amount = round($ot_hour_amount * $request->ot_hour);
        $overtime = new Overtime();
        $overtime->employee_id = $request->employee_id;
        $overtime->ot_hour = $request->ot_hour;
        $overtime->ot_amount = $ot_amount;
        $overtime->month = $request->month;
        $overtime->year = $request->year;
        $overtime->date = $request->date;
        $overtime->created_at = Carbon::now();
        $overtime->save();


        $notification = array(
            'message' => 'Overtime Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.overtime')->with($notification);
    }

    public function EditOvertime($id)
    {
        $overtimeInfo = Overtime::findOrFail($id);
        $employees = Employee::orderBy('name', 'desc')->get();
        $years = [];
        $currentYear = date('Y');
        for ($year = 2000; $year <= $currentYear; $year++) {
            $years[$year] = $year;
        }
        return view('admin.salary.overtime.edit_overtime', compact('overtimeInfo', 'employees', 'years'));
    }


    public function UpdateOvertime(Request $request)
    {
        $overtime_id = $request->id;
        $employeeSalary = Employee::where('id', $request->employee_id)->first()['salary'];



        $month = Carbon::parse($request->month)->format('m');
        $numberOfDay = Carbon::now()->month($month)->year($request->year)->daysInMonth;
        $employeeSalary = Employee::where('id', $request->employee_id)->first()['salary'];

        $ot_hour_amount =  ($employeeSalary / $numberOfDay) / 8;
        $ot_amount = round($ot_hour_amount * $request->ot_hour);


        Overtime::findOrFail($overtime_id)->update([
            'employee_id' => $request->employee_id,
            'ot_hour' => $request->ot_hour,
            'ot_amount' => $ot_amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
        ]);


        $notification = array(
            'message' => 'Overtime Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.overtime')->with($notification);
    }



    public function DeleteOvertime($id)
    {
        Overtime::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Overtime Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.overtime')->with($notification);
    }


    // all bonud method
    public function AllBonus()
    {
        $allBonus = Bonus::all();
        return view('admin.salary.bonus.all_bonus', compact('allBonus'));
    }

    public function AddBonus()
    {
        $years = $this->getYears();
        $employees = Employee::orderBy('name', 'desc')->get();
        return view('admin.salary.bonus.add_bonus', compact('employees', 'years'));
    }
    public function StoreBonus(Request $request)
    {

        $bonusSalary = Bonus::where('month', $request->month)->where('employee_id', $request->employee_id)->first();

        if ($bonusSalary === NULL) {
            $bonus = new Bonus();
            $bonus->employee_id = $request->employee_id;
            $bonus->bonus_amount = $request->bonus_amount;
            $bonus->month = $request->month;
            $bonus->year = $request->year;
            $bonus->date = $request->date;
            $bonus->created_at = Carbon::now();
            $bonus->save();


            $notification = array(
                'message' => 'Bonus Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.bonus')->with($notification);
        } else {
            $notification = array(
                'message' => 'Bonus Salary Already Added!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateBonus(Request $request)
    {
        $bonus_id = $request->id;

        Bonus::findOrFail($bonus_id)->update([
            'employee_id' => $request->employee_id,
            'bonus_amount' => $request->bonus_amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
        ]);

        $notification = array(
            'message' => 'Bonus Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.bonus')->with($notification);
    }
    public function EditBonus($id)
    {
        $bonusInfo = Bonus::findOrFail($id);
        $employees = Employee::orderBy('name', 'desc')->get();
        $years = [];
        $currentYear = date('Y');
        for ($year = 2000; $year <= $currentYear; $year++) {
            $years[$year] = $year;
        }
        return view('admin.salary.bonus.edit_bonus', compact('bonusInfo', 'employees', 'years'));
    }

    public function DeleteBonus($id)
    {
        Bonus::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Bonus Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.bonus')->with($notification);
    }



    // payment details method
    public function EmployeePaymentDetails($id)
    {
        $employee = Employee::findOrFail($id);
        $year = $this->checkRequestYear();
        $payment_salary = PaySalary::where('employee_id', $id)
            ->get();
        return view('admin.salary.pay_salary.payment_details', compact('employee', 'payment_salary', 'year'));
    }


    public function checkRequestYear()
    {
        $firstOfThisMonth = date('Y-m') . '-01';
        $requestMonth = date('F', strtotime($firstOfThisMonth . ' -1 month'));
        if ($requestMonth == 'December') {
            $year = date('Y', strtotime('-1 year'));
        } else {
            $year = date('Y');
        }
        return $year;
    }

    public function getYears()
    {
        $years = [];
        $currentYear = date('Y');
        for ($year = 1900; $year <= $currentYear; $year++) {
            $years[$year] = $year;
        }
        return $years;
    }
}
