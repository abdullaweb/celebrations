<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function AllPurchase()
    {
        $allPurchase = Purchase::all();
        return view('admin.purchase_page.all_purchase', compact('allPurchase'));
    }

    public function AddPurchase()
    {
        return view('admin.purchase_page.add_purchase');
    }

    public function StorePurchase(Request $request)
    {
        $request['product_name'] = Str::lower($request['product_name']);

        $validatedData = $request->validate(
            [
                'product_name' => ['unique:purchases', 'required'],
            ],
            [
                'product_name.unique' => 'Product Name already added if you update stock then click update stock from all purchase menu',
            ]
        );


        Purchase::insert([
            'product_name' => $request->product_name,
            'date' => date('Y-m-d', strtotime($request->date)),
            'product_qty' => $request->product_qty,
            'product_price' => $request->product_price,
            'total_amount' => $request->total_amount,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Purchase Addedd Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.purchase')->with($notification);
    }


    public function EditPurchase($id)
    {
        $purchaseInfo = Purchase::findOrFail($id);
        return view('admin.purchase_page.edit_purchase', compact('purchaseInfo'));
    }

    public function UpdatePurchase(Request $request)
    {
        $purchaseId  =  $request->id;
        Purchase::findOrFail($purchaseId)->update([
            'product_name' => $request->product_name,
            'product_qty' => $request->product_qty,
            'product_price' => $request->product_price,
            'total_amount' => $request->total_amount,
        ]);

        $notification = array(
            'message' => 'Purchase Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.purchase')->with($notification);
    }

    public function GetPurchase(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;


        if ($start_date == null && $end_date == null) {
            $allPurchase = Purchase::all();
        }

        if ($start_date && $end_date) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $allPurchase = Purchase::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
                ->get();
        }

        return view('admin.purchase_page.search_purchase_result', compact('allPurchase', 'start_date', 'end_date',));
    }

    public function StockPurchase(Request $request, $id)
    {
        $purchaseInfo = Purchase::findOrFail($id);
        $purchases = Purchase::all();
        return view('admin.purchase_page.stock_purchase', compact('purchases', 'purchaseInfo'));
    }

    public function UpdateStockPurchase(Request $request)
    {
        $purchase_id = $request->id;

        $purchase = Purchase::findOrFail($request->id);


        $quantity = $purchase->product_qty + $request->product_qty;
        $total = $purchase->total_amount + $request->total_amount;

        Purchase::findOrFail($purchase_id)->update([
            'product_name' => $request->product_name,
            'product_qty' => $quantity,
            'product_price' => $request->product_price,
            'total_amount' => $total,
        ]);

        $notification = array(
            'message' => 'Stock Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.purchase')->with($notification);
    }


    public function StockDeduct(Request $request, $id)
    {
        $purchaseInfo = Purchase::findOrFail($id);
        $purchases = Purchase::all();
        return view('admin.purchase_page.deduct_stock', compact('purchases', 'purchaseInfo'));
    }

    public function StockDeductUpdate(Request $request)
    {
        $deduct_id = $request->id;

        $purchase = Purchase::findOrFail($request->id);


        $quantity = $purchase->product_qty - $request->duduct_qty;
        $total =  $purchase->product_price * $quantity;


        Purchase::findOrFail($deduct_id)->update([
            'product_name' => $request->product_name,
            'product_qty' => $quantity,
            'total_amount' => $total,
        ]);

        $notification = array(
            'message' => 'Stock Deduct Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.purchase')->with($notification);
    }




    public function DeletePurchase($id)
    {
        Purchase::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Purchase Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
