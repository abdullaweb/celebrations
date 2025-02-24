<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\OverTime;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\AccountDetail;
use App\Models\WastesSale;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AccountController extends Controller
{

    /*######### start expense method  #################**/
    public function AllExpense()
    {
        $allExpense = Expense::all();
        return view('admin.accounts.expense_page.all_expense', compact('allExpense'));
    }
    public function AddExpense()
    {
        $employees = Employee::all();
        return view('admin.accounts.expense_page.add_expense', compact('employees'));
    }

    public function StoreExpense(Request $request)
    {
        $expense = new Expense();
        if ($request->expense_head == 'Other') {
            $expense->head = $request->others;
        } else {
            $expense->head = $request->expense_head;
        }
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->created_at = Carbon::now();
        $expense->save();

        $notification = array(
            'message' => 'Expense Addedd Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.expense')->with($notification);
    }


    public function EditExpense($id)
    {
        $expenseInfo = Expense::findOrFail($id);
        return view('admin.accounts.expense_page.edit_expense', compact('expenseInfo'));
    }

    public function UpdateExpense(Request $request)
    {
        $expense = Expense::where('id', $request->id)->first();

        if ($request->others) {
            $expense->description = $request->others;
        } else {
            $expense->description = $request->description;
        }
        $expense->amount = $request->amount;
        $expense->created_at = Carbon::now();
        $expense->save();
        $notification = array(
            'message' => 'Expense updated Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.expense')->with($notification);
    }

    public function MonthlyExpense()
    {
        $current_month = date('m');
        $monthlyExpense = Expense::whereMonth('created_at', $current_month)->get();

        $totalMonthlyExpense = Expense::whereMonth('created_at', $current_month)->sum('amount');
        return view('admin.accounts.expense_page.monthly_expense', compact('monthlyExpense', 'totalMonthlyExpense'));
    }

    public function DailyExpense()
    {
        $today = date('Y-m-d');
        $todayExpense = Expense::whereDate('created_at', $today)->get();
        $totalDailyExpense = Expense::whereDate('created_at', $today)->sum('amount');
        return view('admin.accounts.expense_page.daily_expense', compact('todayExpense', 'totalDailyExpense'));
    }


    public function YearlyExpense()
    {
        $current_year = date('Y');
        $yearlyExpense = Expense::whereYear('created_at', $current_year)->get();
        $totalYearlyExpense = Expense::whereYear('created_at', $current_year)->sum('amount');
        return view('admin.accounts.expense_page.yearly_expense', compact('yearlyExpense', 'totalYearlyExpense'));
    }


    public function GetExpense(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // dd($start_date,$end_date,$interest_subject);

        if ($start_date == null && $end_date == null) {
            $allExpense = Expense::paginate(2);
        }

        if ($start_date && $end_date) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $allExpense = Expense::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
        }

        return view('admin.accounts.expense_page.search_expense_result', compact('allExpense', 'start_date', 'end_date',));
    }

    public function DeleteExpense($id)
    {
        Expense::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Expense Deleted Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.expense')->with($notification);
    }

    /*######### End All expense method  #################**/


    /*######### Start Prodile Calculate method  #################**/
    public function AddProfit()
    {
        // $purchaseData = Purchase::get();
        // $expenseData = Expense::get();
        // return view('admin.accounts.profit.add_profit', compact('purchaseData','expenseData'));
        return view('admin.accounts.profit.add_profit');
    }


    public function GetProfit(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $expense = Expense::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
            $purchase = Purchase::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
            $payment = Payment::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
            $wastes = WastesSale::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
        }

        $total_sale = $payment->sum('paid_amount');
        $total_wastes_sale = $wastes->sum('amount');
        $total_purchase = $purchase->sum('purchase_amount');
        $total_expense = $expense->sum('amount');
        $profit =  $total_sale + $total_wastes_sale - ($total_purchase + $total_expense);
        return view('admin.accounts.profit.result', compact('profit', 'startDate', 'endDate'));
    }
    
    
    

    // opening balance method
    public function AllOpeningBalance()
    {
        $allOpening = AccountDetail::where('status', '1')->get();
        return view('admin.local_customer.opening_balance.all_opening', compact('allOpening'));
    }
    public function AddOpeningBalance()
    {
        $companies = Company::where('status', '0')->get();
        return view('admin.local_customer.opening_balance.add_opening', compact('companies'));
    }
    

    public function StoreOpeningBalance(Request $request)
    {

        if ($request->opening_type == 'opening_balance') {
            $account_details = new AccountDetail();
            $account_details->total_amount = $request->total_amount;
            $account_details->paid_amount = $request->paid_amount;
            $account_details->due_amount = $request->total_amount - $request->paid_amount;
            $account_details->company_id = $request->company_id;
            $account_details->date = date('Y-m-d', strtotime($request->date));
            $account_details->status = '1';
            $account_details->save();

            $notification = array(
                'message' => 'Opening Balance Added Successfully!',
                'alert_type' => 'success',
            );
        } elseif ($request->opening_type == 'billwise_balance') {
            $account_details = new AccountDetail();
            $account_details->invoice_id = $request->bill_no;
            $account_details->total_amount = $request->total_amount;
            $account_details->paid_amount = $request->paid_amount;
            $account_details->due_amount = $request->total_amount - $request->paid_amount;
            $account_details->company_id = $request->company_id;
            $account_details->date = date('Y-m-d', strtotime($request->date));
            $account_details->status = '1';
            $account_details->save();

            $notification = array(
                'message' => 'Opening Bill Added Successfully!',
                'alert_type' => 'success',
            );
        }

        return redirect()->route('all.opening.balance')->with($notification);
    }


    public function EditOpeningBalance($id)
    {
        $accountInfo = AccountDetail::findOrFail($id);
        $companies = Company::where('status', '0')->get();
        return view('admin.local_customer.opening_balance.edit_opening', compact('accountInfo', 'companies'));
    }


    public function UpdateOpeningBalance(Request $request)
    {

        $accountId = $request->id;
        if ($request->opening_type == 'opening_balance') {
            AccountDetail::findOrFail($accountId)->update([
                'invoice_id' => null,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'company_id' => $request->company_id,
                'due_amount' => $request->total_amount - $request->paid_amount,
                'date' => date('Y-m-d', strtotime($request->date)),
            ]);
            $notification = array(
                'message' => 'Balance Updated Successfully',
                'alert_type' => 'success'
            );
        } elseif ($request->opening_type == 'billwise_balance') {

            AccountDetail::findOrFail($accountId)->update([
                'invoice_id' => $request->bill_no,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'company_id' => $request->company_id,
                'due_amount' => $request->total_amount - $request->paid_amount,
                'date' => date('Y-m-d', strtotime($request->date)),
            ]);
            $notification = array(
                'message' => 'Bill Updated Successfully',
                'alert_type' => 'success'
            );
        }

        return redirect()->route('all.opening.balance')->with($notification);
    }


    public function DeleteOpeningBalance($id)
    {
        AccountDetail::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Balance Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.opening.balance')->with($notification);
    }
    
    // account details filtering method
    public function GetAccountDetails(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $company_id = $request->company_id;

        if ($start_date == null && $end_date == null) {
            $billDetails = AccountDetail::all();
        }

        if ($start_date && $end_date) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $billDetails = AccountDetail::whereBetween('created_at', [$start_date, Carbon::parse($end_date)->endOfDay()])->where('company_id', $request->company_id)
                ->get();
        }
        return view('admin.report.account_detials_report', compact('billDetails', 'start_date', 'end_date', 'company_id'));
    }

}
