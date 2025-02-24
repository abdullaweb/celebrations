<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CustomerPaymentDetail;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function CustomerLedgerList()
    {
        $customers = Company::latest()->get();
        $title = 'Customer Ledger';
        return view('admin.ledger.customer_ledger', compact('customers', 'title'));
    }


    public function CustomerDuePayment(Request $request)
    {

        $due_amount = $request->due_amount;

        $request->validate(
            [
                'paid_amount' => 'required',
                'bank_id' => 'required',
                'date' => 'required'
            ],
            [
                'paid_amount.required' => 'Paid Amount is required',
                'bank_id.required' => 'Paid Source is required',
                'date.required' => 'Date is required',
            ]
        );



        if ($request->paid_amount > $due_amount) {
            return response()->json([
                'status' => 'error',
            ]);
        } else {
            $customer_id = $request->customer_id;
            $customer = Company::findOrFail($customer_id);
            // dd($customer);
            $customer->total_due -= $request->paid_amount;
            $customer->update();


            $paymentInfo = Payment::where('company_id', $customer_id)->latest()->first();
            if ($paymentInfo) {
                $paymentInfo->paid_amount += $request->paid_amount;
                // $paymentInfo->previous_due -= $request->paid_amount;
                if ($paymentInfo->due_amount <= $request->paid_amount) {
                    $paymentInfo->due_amount = 0;
                } else {
                    $paymentInfo->due_amount -= $request->paid_amount;
                }
                $paymentInfo->update();
            }




            // save data to supplier purchase details
            $payment_details = new CustomerPaymentDetail();
            $payment_details->customer_id = $request->customer_id;
            $payment_details->invoice_id = 'Due Payment';
            $payment_details->bank_id = $request->bank_id;
            $payment_details->paid_amount = $request->paid_amount;
            $payment_details->note = 'Due Payment';
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->created_at = Carbon::now();
            $payment_details->save();

            return response()->json([
                'status' => 'success',
            ]);
        }
    }

    public function CustomerPaymentHistory($id)
    {
        $totalOrder = Payment::where('payments.company_id', $id)
            ->join('payment_details', 'payments.invoice_id', '=', 'payment_details.invoice_id')
            ->get(['payment_details.*']);
        $customerInfo = Company::findOrFail($id);
        $paymentSummery = CustomerPaymentDetail::where('customer_id', $id)->get();
        return view('admin.ledger.customer_payment_history', compact('totalOrder', 'paymentSummery', 'customerInfo'));
    }
    
    // due bill ledger
    public function DueBillLedger()
    {
        $allData = Payment::where('due_amount', '!=', '0')->get();
        return view('admin.ledger.due_bill_list', compact('allData'));
    }
}
