<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;
use Carbon\Carbon;

class TaxController extends Controller
{
     public function AllTax()
    {
        $allTax = Tax::OrderBy('name')->get();
        $title = 'Tax';
        return view('admin.tax.all_tax', compact('allTax', 'title'));
    }

    public function AddTax()
    {
        $title = 'Tax';
        return view('admin.tax.add_tax', compact('title'));
    }
    public function StoreTax(Request $request)
    {
        $tax = new Tax();
        $tax->name = $request->name;
        $tax->rate = $request->rate;
        $tax->created_at = Carbon::now();
        $tax->save();

        $notification = array(
            'message' => 'Tax added Successfully!',
            'alert_type' => 'success',
        );
        return redirect()->route('all.tax')->with($notification);
    }


    public function EditTax($id)
    {
        $title = 'Tax Update';
        $taxInfo = Tax::findOrFail($id);
        return view('admin.tax.edit_tax', compact('taxInfo', 'title'));
    }

    public function UpdateTax(Request $request)
    {
        $tax_id = $request->id;
        $tax = Tax::findOrFail($tax_id);
        $tax->name = $request->name;
        $tax->rate = $request->rate;
        $tax->update();

        $notification = array(
            'message' => 'Tax Updated Successfully!',
            'alert_type' => 'success',
        );
        return redirect()->route('all.tax')->with($notification);
    }

    public function DeleteTax($id)
    {
        Tax::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Tax Deleted Successfully!',
            'alert_type' => 'success',
        );
        return redirect()->route('all.tax')->with($notification);
    }

    public function DeactiveTax($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->status = '0';
        $tax->update();

        $notification = array(
            'message' => 'Tax Deactived Successfully!',
            'alert_type' => 'success',
        );
        return redirect()->route('all.tax')->with($notification);
    }

    public function ActiveTax($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->status = '1';
        $tax->update();

        $notification = array(
            'message' => 'Tax Actived Successfully!',
            'alert_type' => 'success',
        );
        return redirect()->route('all.tax')->with($notification);
    }



    public function GetTaxPercentage($id)
    {
        $percentage = Tax::where('id', $id)->first()['rate'];
        return response()->json($percentage);
        // dd($percentage);
    }
}
