<?php

namespace App\Http\Controllers;

use App\Models\WastesSale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WastesSaleController extends Controller
{
    public function AllWastesSale()
    {
        $allWastesSale = WastesSale::all();
        return view('admin.wastes_sale.all_wastes_sale', compact('allWastesSale'));
    }

    public function AddWastesSale()
    {
        return view('admin.wastes_sale.add_wastes_sale');
    }

    public function StoreWastesSale(Request $request)
    {
        WastesSale::insert([
            'name' => $request->name,
            'amount' => $request->amount,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Wastes Sale Addedd Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.wastes.sale')->with($notification);
    }

    public function EdtWastesSale($id)
    {
        $wastesInfo = WastesSale::findOrFail($id);
        return view('admin.wastes_sale.edit_wastes_sale', compact('wastesInfo'));
    }

    public function UpdateWastesSale(Request $request)
    {
        $wastesId  =  $request->id;
        WastesSale::findOrFail($wastesId)->update([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        $notification = array(
            'message' => 'Wastes Sale Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.wastes.sale')->with($notification);
    } //end method

}
