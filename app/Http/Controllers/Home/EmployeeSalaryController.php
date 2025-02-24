<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeePayment;
use App\Models\EmployeePaymentDetails;
use App\Models\EmployeeSalaryLog;
use App\Models\AdvancedSalary;
use App\Models\OverTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    public function SalaryView()
    {
        $allData = Employee::all();
        return view('admin.employee_page.salary.employee_salary_view', compact('allData'));
    } //end method

    public function SalaryIncrement($id)
    {
        $allData = Employee::findOrFail($id);
        return view('admin.employee_page.salary.employee_salary_increment', compact('allData'));
    } //end method

    public function SalaryIncrementUpdate(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $previous_salary = $employee->salary;
        $present_salary = (float)$previous_salary + $request->increment_salary;
        $employee->salary = $present_salary;
        $employee->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->emp_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Employee Salary Increment Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.salary.view')->with($notification);
    } //end method

    public function SalaryDetails($id)
    {
        $employee = Employee::findOrFail($id);
        $salaryData = EmployeeSalaryLog::where('emp_id', $employee->id)->get();
        return view('admin.employee_page.salary.employee_salary_details', compact('salaryData', 'employee'));
    } //end method


     public function AddOverTime(Request $request)
    {
        $employee = Employee::findOrFail($request->up_id);
        $day_amount = $employee->salary / 30;
        $ot_salary = ($day_amount / 8) * $request->ot_hour;
        $ot_payment = round($ot_salary);

        $date = Carbon::createFromFormat('m/d/Y', date('m/d/Y', strtotime($request->effected_date)));
        $monthName = $date->format('F');
        $year = $date->format('Y');
        $overtime = new OverTime();
        $overtime->emp_id = $employee->id;
        $overtime->previous_salary = $employee->salary;
        $overtime->ot_payment = $ot_payment;
        $overtime->ot_hour = $request->ot_hour;
        $overtime->effected_date = date('Y-m-d', strtotime($request->effected_date));
        $overtime->month = $monthName;
        $overtime->year = $year;
        $overtime->created_at = Carbon::now();
        $overtime->save();

        $employee_payment = EmployeePayment::orderBy('id', 'desc')->first();
        if ($employee_payment == null) {
            $employee_data = new EmployeePayment();
            $employee_data->emp_id = $request->up_id;
            $employee_data->ot_hour = $request->ot_hour;
            $employee_data->ot_payment = $ot_payment;
            $employee_data->paid_amount = 0;
            $employee_data->bonus = 0;
            $employee_data->basic_salary = $employee->salary;
            $employee_data->effected_date = date('Y-m-d', strtotime($request->effected_date));
            $employee_data->month = $monthName;
            $employee_data->year = $year;
            $employee_data->total_amount = $employee->salary + $ot_payment + $employee_data->bonus;
            $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
            $employee_data->save();
        } else {

            $is_exits = EmployeePayment::where('emp_id', $request->up_id)->latest()->first();
            if ($is_exits === null || ($is_exits->emp_id == $request->up_id && $is_exits->month != $monthName)) {
                $employee_data = new EmployeePayment();
                $employee_data->emp_id = $request->up_id;
                $employee_data->ot_hour = $request->ot_hour;
                $employee_data->ot_payment = $ot_payment;
                $employee_data->paid_amount = 0;
                $employee_data->bonus = 0;
                $employee_data->basic_salary = $employee->salary;
                $employee_data->effected_date = date('Y-m-d', strtotime($request->effected_date));
                $employee_data->month = $monthName;
                $employee_data->year = $year;
                $employee_data->total_amount = $employee->salary + $ot_payment + $employee_data->bonus;
                $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
                $employee_data->save();
            } elseif ($is_exits->emp_id == $request->up_id && $is_exits->month == $monthName) {
                $current_ot_hour = $is_exits->ot_hour + $request->ot_hour;
                $current_ot_payment = $is_exits->ot_payment + $ot_payment;
                $current_payable_amount = $is_exits->payable_amount + $ot_payment;
                $current_total = $is_exits->total_amount + $ot_payment;
                EmployeePayment::where('emp_id', $request->up_id)->update([
                    'ot_payment' => $current_ot_payment,
                    'ot_hour' => $current_ot_hour,
                    'payable_amount' => $current_payable_amount,
                    'total_amount' => $current_total,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
        ]);
    } //end method


 public function AddPayment(Request $request)
    {

        $date = Carbon::createFromFormat('m/d/Y', date('m/d/Y', strtotime($request->date)));
        $monthName = $date->format('F');
        $year = $date->format('Y');


        $payment_type = $request->payment_type;

        if ($payment_type == 'salary') {
            $employee = Employee::findOrFail($request->up_id);
            $employee_payment = EmployeePayment::orderBy('id', 'desc')->first();
            if ($employee_payment == null) {
                $employee_data = new EmployeePayment();
                $employee_data->emp_id = $request->up_id;
                $employee_data->ot_hour = 0;
                $employee_data->ot_payment = 0;
                $employee_data->paid_amount = $request->pay_amount;
                $employee_data->bonus = 0;
                $employee_data->basic_salary = $employee->salary;
                $employee_data->effected_date = date('Y-m-d', strtotime($request->date));
                $employee_data->month = $monthName;
                $employee_data->year = $year;
                $employee_data->total_amount = $employee->salary +  $employee_data->ot_payment;
                $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
                $employee_data->save();

                $payment_details = new EmployeePaymentDetails();
                $payment_details->emp_id = $request->up_id;
                $payment_details->voucher = $request->voucher;
                $payment_details->date = date('Y-m-d', strtotime($request->date));
                $payment_details->month = $monthName;
                $payment_details->year = $year;
                $payment_details->paid_amount = $request->pay_amount;
                $payment_details->save();
            } else {
                $is_exits = EmployeePayment::where('emp_id', $request->up_id)->latest()->first();
                if ($is_exits === null || ($is_exits->emp_id == $request->up_id && $is_exits->month != $monthName)) {
                    $employee_data = new EmployeePayment();
                    $employee_data->emp_id = $request->up_id;
                    $employee_data->ot_hour = 0;
                    $employee_data->ot_payment = 0;
                    $employee_data->paid_amount = $request->pay_amount;
                    $employee_data->bonus = 0;
                    $employee_data->basic_salary = $employee->salary;
                    $employee_data->effected_date = date('Y-m-d', strtotime($request->date));
                    $employee_data->month = $monthName;
                    $employee_data->year = $year;
                    $employee_data->total_amount = $employee->salary + $employee_data->ot_payment;
                    $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
                    $employee_data->save();

                    $payment_details = new EmployeePaymentDetails();
                    $payment_details->emp_id = $request->up_id;
                    $payment_details->voucher = $request->voucher;
                    $payment_details->date = date('Y-m-d', strtotime($request->date));
                    $payment_details->month = $monthName;
                    $payment_details->year = $year;
                    $payment_details->paid_amount = $request->pay_amount;
                    $payment_details->save();
                } elseif ($is_exits->emp_id == $request->up_id && $is_exits->month == $monthName) {
                    $current_paid_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['paid_amount'] + $request->pay_amount;
                    $current_payable_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['total_amount'] - $current_paid_amount;
                    EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->update([
                        'payable_amount' => $current_payable_amount,
                        'paid_amount' => $current_paid_amount,
                    ]);

                    $payment_details = new EmployeePaymentDetails();
                    $payment_details->emp_id = $request->up_id;
                    $payment_details->payment_type = $request->payment_type;
                    $payment_details->voucher = $request->voucher;
                    $payment_details->date = date('Y-m-d', strtotime($request->date));
                    $payment_details->month = $monthName;
                    $payment_details->year = $year;
                    $payment_details->paid_amount = $request->pay_amount;
                    $payment_details->save();
                }
            }

            return response()->json([
                'status' => 'success',
            ]);
        } else {
            
            $current_advanced = AdvancedSalary::where('emp_id', $request->up_id)->first()['advanced_amount'];
            if ($current_advanced >  $request->pay_amount) {

                $payment_details = new EmployeePaymentDetails();
                $payment_details->emp_id = $request->up_id;
                $payment_details->payment_type = $request->payment_type;
                $payment_details->voucher = $request->voucher;
                $payment_details->date = date('Y-m-d', strtotime($request->date));
                $payment_details->month = $monthName;
                $payment_details->year = $year;
                $payment_details->paid_amount = $request->pay_amount;
                $payment_details->save();

                AdvancedSalary::where('emp_id', $request->up_id)->update([
                    'advanced_amount' => $current_advanced - $request->pay_amount,
                ]);

                return response()->json([
                    'status' => 'success',
                ]);
            } elseif ($current_advanced <  $request->pay_amount) {

                return response()->json([
                    'status' => 'error',
                ]);
            }
        }
    } //end method

    
    
    // add bonus method
    public function AddBonus(Request $request)
    {
        $date = Carbon::createFromFormat('m/d/Y', date('m/d/Y', strtotime($request->date)));
        $monthName = $date->format('F');
        $year = $date->format('Y');

        $employee = Employee::findOrFail($request->up_id);
        $employee_payment = EmployeePayment::orderBy('id', 'desc')->first();
        if ($employee_payment == null) {
            $employee_data = new EmployeePayment();
            $employee_data->emp_id = $request->up_id;
            $employee_data->ot_hour = 0;
            $employee_data->ot_payment = 0;
            $employee_data->paid_amount = 0;
            $employee_data->bonus = $request->bonus_amount;
            $employee_data->basic_salary = $employee->salary;
            $employee_data->effected_date = date('Y-m-d', strtotime($request->date));
            $employee_data->month = $monthName;
            $employee_data->year = $year;
            $employee_data->total_amount = $employee->salary + $request->bonus_amount;
            $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
            $employee_data->save();
        } else {
            $is_exits = EmployeePayment::where('emp_id', $request->up_id)->latest()->first();
            if ($is_exits === null || ($is_exits->emp_id == $request->up_id && $is_exits->month != $monthName)) {
                $employee_data = new EmployeePayment();
                $employee_data->emp_id = $request->up_id;
                $employee_data->ot_hour = 0;
                $employee_data->ot_payment = 0;
                $employee_data->paid_amount = 0;
                $employee_data->bonus = $request->bonus_amount;
                $employee_data->basic_salary = $employee->salary;
                $employee_data->effected_date = date('Y-m-d', strtotime($request->date));
                $employee_data->month = $monthName;
                $employee_data->year = $year;
                $employee_data->total_amount = $employee->salary + $request->bonus_amount;
                $employee_data->payable_amount = $employee_data->total_amount - $employee_data->paid_amount;
                $employee_data->save();
            } elseif ($is_exits->emp_id == $request->up_id && $is_exits->month == $monthName) {
                $current_bonus_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['bonus'] + $request->bonus_amount;
                $current_total_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['total_amount'] + $request->bonus_amount;
                $current_payable_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['payable_amount'] + $request->bonus_amount;

                EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->update([
                    'payable_amount' => $current_payable_amount,
                    'bonus' => $current_bonus_amount,
                    'total_amount' => $current_total_amount,
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
        ]);
    } //end method



    public function PaidSalary(Request $request)
    {

        $todayDate = Carbon::now()->format('Y-m-d');
        $date = Carbon::createFromFormat('m/d/Y', date('m/d/Y', strtotime($todayDate)));
        $monthName = $date->format('F');
        $year = $date->format('Y');

        $current_payable_amount = EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->first()['total_amount'];

        EmployeePayment::where('emp_id', $request->up_id)->where('month', $monthName)->update([
            'payable_amount' => '0',
            'paid_amount' => $current_payable_amount,
        ]);



        $payment_details = new EmployeePaymentDetails();
        $payment_details->emp_id = $request->up_id;
        $payment_details->voucher = $request->voucher;
        $payment_details->date = date('Y-m-d', strtotime($request->date));
        $payment_details->month = $monthName;
        $payment_details->year = $year;
        $payment_details->paid_amount = $request->pay_amount;
        $payment_details->due_amount = $current_payable_amount;
        $payment_details->save();



        return response()->json([
            'status' => 'success',
        ]);
    }


    public function PaymentDetails($id)
    {
        $employee = Employee::findOrFail($id);
        // $data = EmployeePayment::where('emp_id', $employee->id)->where('month','July')->first();
        $data = EmployeePayment::where('emp_id', $employee->id)->get();
        $paymentDetails = EmployeePaymentDetails::where('emp_id', $employee->id)->get();
        // dd($paymentDetails);
        // return view('admin.employee_page.salary.payment_demo', compact('data', 'employee','paymentDetails'));
        return view('admin.employee_page.salary.payment_details_view', compact('data', 'employee'));
        // return view('admin.employee_page.salary.payment_details_view', compact('data', 'employee', 'paymentDetails'));
    }

    public function PaySlip($id)
    {
        $employee = Employee::findOrFail($id);
        $data = EmployeePayment::where('emp_id', $employee->id)->first();
        // dd($data);
        return view('admin.employee_page.salary.pay_slip', compact('data'));
    }


    public function AddMonthlySalary()
    {
        return view('admin.employee_page.salary.get_monthly_salary');
    }

    public function MonthlySalary(Request $request)
    {
        // $date = date('Y-m', strtotime($request->date));
        // if ($date != ' ') {
        //     $where[] = ['effected_date', 'like', $date . '%'];
        //     // $where[] = ['created_at', 'like', $date . '%'];
        // }
        $employees = Employee::get();
        $date = Carbon::createFromFormat('m/d/Y', date('m/d/Y', strtotime($request->date)));
        $month = $date->format('F');
        // $year = $date->format('Y');
        // $month = date('M', strtotime($request->date));
        // $year = date('Y', strtotime($request->date));
        // $getemp = Employee::select('employees.*')
        //     ->join('employee_payments', 'employee_payments.emp_id', '=', 'employees.id')->where('employee_payments.month','=', $month)->get();
        // dd($getemp);
        //     foreach ($employees as $key => $employee) {
        //         foreach($getemp as $currentemp){
        //             if($employee->id !== $currentemp->emp_id){
        //                 EmployeePayment::insert([
        //                     'emp_id'=>$employee->id,
        //                     'ot_hour' => '0',
        //                     'ot_payment' => '0',
        //                     'bonus' => '0',
        //                     'paid_amount' => '0',
        //                     'basic_salary' => $employee->salary,
        //                     'payable_amount' => '0',
        //                     'effected_date' => $request->date,
        //                     'month' => $month,
        //                     'year' => $year,
        //                     'effected_date' => $request->date,
        //                     'total_amount' => $employee->salary,
        //                     'paid_amount' => '0',
        //                     'advanced_amount' => '0',
        //                 ]);
        //             }
        //         }
        //     }
        // dd($hello);
        // dd($hello)
        // dd($getemp);


        // $data = EmployeePayment::where($where)->get();
        $data = EmployeePayment::where('month', $month)->get();
        // dd($data);
        // dd($data);

        return view('admin.employee_page.salary.salary_view', compact('data'));
    }

    public function OtDetails($id)
    {
        $employee = Employee::findOrFail($id);
        $data = OverTime::where('emp_id', $employee->id)->get();
        return view('admin.employee_page.salary.ot_details_view', compact('data', 'employee'));
    }

    public function GetCurrentSalary(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != ' ') {
            $where[] = ['effected_date', 'like', $date . '%'];
        }

        $data = OverTime::where($where)->get();
        $ot = $data->sum('ot_payment');
        $salary = $data->sum('previous_salary');
        $data = $salary + $ot;
        return response()->json($data);
        // dd($data);
    }

    // advanced Salary Method
    public function AddAdvancedSalary()
    {
        $employees = Employee::orderBy('name', 'desc')->get();
        return view('admin.employee_page.advanced_salary.add_advanced', compact('employees'));
    }


    public function StoreAdvancedSalary(Request $request)
    {
        $advanced = new AdvancedSalary();
        $advanced->advanced_amount = $request->advanced_amount;
        $advanced->emp_id = $request->emp_id;
        $advanced->date = $request->date;
        $advanced->created_at = Carbon::now();
        // $current_advanced = EmployeePayment::where('emp_id', $request->emp_id)->first()['advanced_amount'] + $request->advanced_amount;
        // $current_total = EmployeePayment::where('emp_id', $request->emp_id)->first()['total_amount'] + $request->advanced_amount;
        $advanced->save();

        // EmployeePayment::where('emp_id', $request->emp_id)->update([
        //     'advanced_amount' => $current_advanced,
        //     'total_amount' => $current_total,
        // ]);

        $notification = array(
            'message' => 'Advanced Salary Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.advanced.salary')->with($notification);
    }

    public function AllAdvancedSalary()
    {
        $allAdvanced = AdvancedSalary::all();
        return view('admin.employee_page.advanced_salary.all_advanced', compact('allAdvanced'));
    }

    public function EditAdvancedSalary($id)
    {
        $employees = Employee::all();
        $empInfo = Employee::findOrFail($id);
        $advancedSalary = AdvancedSalary::findOrFail($id);
        return view('admin.employee_page.advanced_salary.edit_advanced', compact('empInfo', 'advancedSalary', 'employees'));
    }

    public function UpdateAdvancedSalary(Request $request)
    {
        $emp_id = $request->id;
        $advanced = AdvancedSalary::findOrFail($emp_id);


        $advanced_amount = $advanced->advanced_amount + $request->advanced_amount;

        AdvancedSalary::findOrFail($emp_id)->update([
            'advanced_amount' => $advanced_amount,
            'date' => $request->date,
        ]);

        $notification = array(
            'message' => 'Advanced Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.advanced.salary')->with($notification);
    }

    public function DeleteAdvancedSalary($id)
    {
        AdvancedSalary::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Advanced Salary Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.advanced.salary')->with($notification);
    }
}
