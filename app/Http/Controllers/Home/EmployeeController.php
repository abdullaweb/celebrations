<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePayment;
use App\Models\EmployeePaymentDetails;
use App\Models\EmployeeSalaryLog;
use App\Models\OverTime;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function EmployeeAll()
    {
        $allData = Employee::all();
        return view('admin.employee_page.all_employee', compact('allData'));
    }
    public function EmployeeAdd()
    {
        return view('admin.employee_page.add_employee');
    }

    public function EmployeeStore(Request $request)
    {
        $employee = Employee::orderBy('id', 'desc')->first();
        if ($employee == null) {
            $firstReg = '0';
            $employeeId = $firstReg + 1;
        } else {
            $employee = Employee::orderBy('id', 'desc')->first()->id;
            $employeeId = $employee + 1;
        }

        if ($employeeId < 10) {
            $id_no = '000' . $employeeId; //0009
        } elseif ($employeeId < 100) {
            $id_no = '00' . $employeeId; //0099
        } elseif ($employeeId < 1000) {
            $id_no = '0' . $employeeId; //0999
            $id_no = '0' . $employeeId; //0999
        }

        $check_year = date('Y');

        $name = $request->name;
        $words = explode(' ', $name);
        $acronym = '';
        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }

        $employee_id = $acronym . '-' . $check_year . '.' . $id_no;



        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(200, 200)->save('upload/employee_image/' . $name_gen);
            $save_url = 'upload/employee_image/' . $name_gen;


            $employeeInfo = new Employee();
            $employeeInfo->name = $request->name;
            $employeeInfo->employee_id = $employee_id;
            $employeeInfo->email = $request->email;
            $employeeInfo->phone = $request->phone;
            $employeeInfo->designation = $request->designation;
            $employeeInfo->salary = $request->salary;
            $employeeInfo->address = $request->address;
            $employeeInfo->nid = $request->nid;
            $employeeInfo->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employeeInfo->image =  $save_url;
            $employeeInfo->created_at =  Carbon::now();
            $employeeInfo->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->emp_id = $employeeInfo->id;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->joining_date));
            $employee_salary->save();


            // $overtime = new OverTime();
            // $overtime->emp_id = $employeeInfo->id;
            // $overtime->previous_salary = $request->salary;
            // $overtime->ot_payment = '0';
            // $overtime->effected_date = date('Y-m-d', strtotime($request->joining_date));
            // $overtime->save();

            // $employee_payments = new EmployeePayment();
            // $employee_payments->emp_id = $employeeInfo->id;
            // $employee_payments->ot_hour = '0';
            // $employee_payments->basic_salary = $request->salary;
            // $employee_payments->ot_payment = '0';
            // $employee_payments->bonus = '0';
            // $employee_payments->payable_amount = $request->salary;
            // $employee_payments->total_amount = $request->salary;
            // $employee_payments->effected_date = date('Y-m-d', strtotime($request->joining_date));
            // $employee_payments->save();


            $notification = array(
                'message' => 'Employee Added Successfully',
                'alert-type' => 'success'
            );
        } else {
            $employeeInfo = new Employee();
            $employeeInfo->name = $request->name;
            $employeeInfo->employee_id = $employee_id;
            $employeeInfo->email = $request->email;
            $employeeInfo->phone = $request->phone;
            $employeeInfo->designation = $request->designation;
            $employeeInfo->salary = $request->salary;
            $employeeInfo->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employeeInfo->created_at =  Carbon::now();
            $employeeInfo->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->emp_id = $employeeInfo->id;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->joining_date));
            $employee_salary->save();

            // $overtime = new OverTime();
            // $overtime->emp_id = $employeeInfo->id;
            // $overtime->previous_salary = $request->salary;
            // $overtime->ot_payment = '0';
            // $overtime->effected_date = date('Y-m-d', strtotime($request->joining_date));
            // $overtime->save();

            // $employee_payments = new EmployeePayment();
            // $employee_payments->emp_id = $employeeInfo->id;
            // $employee_payments->ot_hour = '0';
            // $employee_payments->ot_payment = '0';
            // $employee_payments->basic_salary = $request->salary;
            // $employee_payments->bonus = '0';
            // $employee_payments->payable_amount = $request->salary;
            // $employee_payments->total_amount = $request->salary;
            // $employee_payments->effected_date = date('Y-m-d', strtotime($request->joining_date));
            // $employee_payments->save();


            $notification = array(
                'message' => 'Employee Added Successfully Without Image',
                'alert-type' => 'success'
            );
        }
        return redirect()->route('all.employee')->with($notification);
    } //end method


    public function EmployeeEdit($id)
    {
        $employeeInfo = Employee::findOrFail($id);
        return view('admin.employee_page.edit_employee', compact('employeeInfo'));
    }

    public function EmployeeUpdate(Request $request)
    {
        $employeeId = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            $existing_image = Employee::findOrFail($employeeId);
            @unlink($existing_image->image);

            Image::make($image)->resize(200, 200)->save('upload/employee_image/' . $name_gen);
            $save_url = 'upload/employee_image/' . $name_gen;


            Employee::findOrFail($employeeId)->update([
                'name' => $request->name,
                'employee_id' => $request->employee_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'designation' => $request->designation,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Employee Updated Successfully',
                'alert_type' => 'success'
            );
        } else {
            Employee::findOrFail($employeeId)->update([
                'name' => $request->name,
                'employee_id' => $request->employee_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'designation' => $request->designation,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
            ]);
            $notification = array(
                'message' => 'Employee Updated Successfully without image',
                'alert_type' => 'success'
            );
        }

        return redirect()->route('all.employee')->with($notification);
    }

    public function EmployeeView($id)
    {
        $employeeInfo = Employee::findOrFail($id);
        return view('admin.employee_page.view_employee', compact('employeeInfo'));
    }
    public function EmployeeDelete($id)
    {
        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.employee')->with($notification);
    }
}

