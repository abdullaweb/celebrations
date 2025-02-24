<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class OpeningController extends Controller
{

    // customer ledger
    public function  CustomerOpeningLedgerAdd()
    {
        $customers = Company::OrderBy('name', 'asc')->get();
        return view('admin.opening.customer_ledger', compact('customers'));
    }

    public function  CustomerOpeningLedgerStore(Request $request)
    {
        $customer = Company::findOrFail($request->customer_id);
        $customer->total_due += $request->due_amount;
        $customer->update();

        $notification = array(
            'message' => 'Customer ledger Updated Successfully!',
            'alert_type' => 'info',
        );
        return redirect()->route('all.company')->with($notification);
    }
}
