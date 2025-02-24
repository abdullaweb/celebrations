<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BillPayment;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\AccountDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
     public function CustomerAdvancePayment(Request $request){

        $request->validate(
            [
                'advance_amount' => 'required',
                'date' => 'required'
            ],
            [
                'advance_amount.required' => 'Advance Amount is required',
                'date.required' => 'Date is required',
            ]
        );


        $customer_id = $request->customer_id;

        $customer = Company::findOrFail($customer_id);
        $customer->total_deposit += $request->advance_amount;
        $customer->update();


        // save data to supplier purchase details
        $payment_details = new CustomerPaymentDetail();
        $payment_details->customer_id = $request->customer_id;
        $payment_details->bank_id = $request->bank_id;
        $payment_details->paid_amount = $request->advance_amount;
        $payment_details->note = 'Advance Amount';
        $payment_details->date = date('Y-m-d', strtotime($request->date));
        $payment_details->created_at = Carbon::now();
        $payment_details->save();

        return response()->json([
            'status' => 'success',
        ]);


    }
    
    public function CompanyAll()
    {
        $allData = Company::where('status', '1')->get();
        return view('admin.company_page.all_company', compact('allData'));
    }
    public function CompanyAdd()
    {
        return view('admin.company_page.add_company');
    }

    public function CompanyStore(Request $request)
    {
        $company = Company::orderBy('id', 'desc')->first();
        if ($company == null) {
            $firstReg = '0';
            $companyId = $firstReg + 1;
        } else {
            $company = Company::orderBy('id', 'desc')->first()->id;
            $companyId = $company + 1;
        }

        if ($companyId < 10) {
            $id_no = '000' . $companyId; //0009
        } elseif ($companyId < 100) {
            $id_no = '00' . $companyId; //0099
        } elseif ($companyId < 1000) {
            $id_no = '0' . $companyId; //0999
            $id_no = '0' . $companyId; //0999
        }

        $check_year = date('Y');

        $name = $request->name;
        $words = explode(' ', $name);
        $acronym = '';
        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }

        $company_id = $acronym . '-' . $check_year . '.' . $id_no;

        Company::insert([
            'name' => $request->name,
            'company_id' => $company_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'cor_address' => $request->cor_address,
            'bin_number' => $request->bin_number,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Company Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.company')->with($notification);
    } //end method


    public function CompanyEdit($id)
    {
        $companyInfo = Company::findOrFail($id);
        return view('admin.company_page.edit_company', compact('companyInfo'));
    }

    public function CompanyUpdate(Request $request)
    {
        $companyId = $request->id;
        Company::findOrFail($companyId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'cor_address' => $request->cor_address,
            'bin_number' => $request->bin_number,
        ]);

        $notification = array(
            'message' => 'Company Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function CompanyDelete($id)
    {
        $invoiceInfo = Invoice::where('company_id', $id)->get();

        foreach ($invoiceInfo as $invoice) {
            PaymentDetail::where('invoice_id', $invoice->id)->delete();
        }

        Company::findOrFail($id)->delete();
        Invoice::where('company_id', $id)->delete();
        InvoiceDetail::where('company_id', $id)->delete();
        Payment::where('company_id', $id)->delete();
        AccountDetail::where('company_id', $id)->delete();

        $notification = array(
            'message' => 'Company Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.company')->with($notification);
    }
    
    
    public function CompanyBillDelete($id)
    {
        $invoiceInfo = Invoice::where('company_id', $id)->get();

        foreach ($invoiceInfo as $invoice) {
            PaymentDetail::where('invoice_id', $invoice->id)->delete();
        }

        Invoice::where('company_id', $id)->delete();
        InvoiceDetail::where('company_id', $id)->delete();
        Payment::where('company_id', $id)->delete();
        AccountDetail::where('company_id', $id)->delete();

        $notification = array(
            'message' => 'Company Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // credit compnay method
    public function CreditCustomer()
    {
        // $allData = Payment::whereIn('paid_status', ['partial_paid', 'full_due'])->where('due_amount', '!=', '0')->get();
        $allData = Payment::where('due_amount', '!=', '0')->get();
        return view('admin.company_page.credit_company', compact('allData'));
    }


    public function EditCreditCustomerInvoice($invoice_id)
    {
        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('admin.company_page.edit_customer_invoice', compact('payment'));
    }

    public function UpdateCustomerInvoice(Request $request, $invoice_id)
    {
        if ($request->new_paid_amount < $request->paid_amount) {
            $notification = array(
                'message' => 'Sorry, You Paid maximum amount!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $payment->check_number = $request->check_number;
                $payment_details->current_paid_amount = $request->new_paid_amount;
            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment->check_number = $request->check_number;
                $payment_details->current_paid_amount = $request->paid_amount;
            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

            $notification = array(
                'message' => 'Payment Updated Successfully!',
                'alert_type' => 'success',
            );
            return redirect()->route('all.company')->with($notification);
        }
    }


    public function CustomerInvoiceDetails($invoice_id)
    {
        $payment = Payment::where('invoice_id', $invoice_id)->first();
        // dd($payment);
        return view('admin.pdf.invoice_details_pdf', compact('payment'));
    }


    public function CompanyBill($id)
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('invoice_no', 'desc')->where('company_id', $id)->where('status', '1')->get();
        $companyInfo = Company::findOrFail($id);
        return view('admin.company_page.company_invoice', compact('allData','id','companyInfo'));
    }




    // local Company all method
    public function CustomerAll()
    {
        $allData = Company::where('status', '0')->get();
        return view('admin.local_customer.all_customer', compact('allData'));
    }
    public function CustomerAdd()
    {
        return view('admin.local_customer.add_customer');
    }

    public function CustomerStore(Request $request)
    {
        $company = Company::orderBy('id', 'desc')->first();
        if ($company == null) {
            $firstReg = '0';
            $companyId = $firstReg + 1;
        } else {
            $company = Company::orderBy('id', 'desc')->first()->id;
            $companyId = $company + 1;
        }

        if ($companyId < 10) {
            $id_no = '000' . $companyId; //0009
        } elseif ($companyId < 100) {
            $id_no = '00' . $companyId; //0099
        } elseif ($companyId < 1000) {
            $id_no = '0' . $companyId; //0999
            $id_no = '0' . $companyId; //0999
        }

        $check_year = date('Y');

        $name = $request->name;
        $words = explode(' ', $name);
        $acronym = '';
        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }

        $company_id = $acronym . '-' . $check_year . '.' . $id_no;


        Company::insert([
            'name' => $request->name,
            'company_id' => $company_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'status' => '0',
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    } //end method



    public function CompanyBillLocal($id)
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('invoice_no', 'desc')->where('company_id', $id)->where('status', '0')->get();
        $accountBill = AccountDetail::where('company_id', $id)->get();
        return view('admin.local_customer.local_company_invoice', compact('allData', 'accountBill'));
    }

    public function LocalCompanyDuePayment($id)
    {
        $companyInfo = Company::where('id', $id)->first();
        $companyBill = BillPayment::where('company_id', $id)->get();
        $accountBill = AccountDetail::where('company_id', $id)->get();
        return view('admin.local_customer.company_due_payment', compact('companyBill', 'accountBill', 'companyInfo'));
    }

    public function LocalCompanyDuePaymentStore(Request $request)
    {
        $company_id = $request->id;
        if ($request->paid_amount > $request->due_amount) {
            $notification = array(
                'message' => 'Sorry, Paid amount is maximum the due amount',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {

            if ($request->paid_status == 'check' || $request->paid_status == 'online-banking') {
                $paid_status = $request->paid_status;
                $check_number = $request->check_or_banking;
            } else {
                $paid_status = $request->paid_status;
                $check_number = null;
            }
    
            $account_details = new AccountDetail();
            $account_details->paid_amount = $request->paid_amount;
            $account_details->voucher = $request->voucher;
            $account_details->company_id = $company_id;
            $account_details->date = date('Y-m-d', strtotime($request->date));
            $account_details->save();
            
            
            $notification = array(
                'message' => 'Payment Updated Successfully!',
                'alert_type' => 'success',
            );
            return redirect()->route('all.customer')->with($notification);
        }
    }//end method
    
    public function CompanyBillLocalDetails($id)
    {
        $billDetails = AccountDetail::where('company_id', $id)->get();
        $companyInfo = Company::where('id', $id)->first();
        return view('admin.local_customer.company_bill_details', compact('billDetails','companyInfo'));
    }
}
