<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
      public function CategoryReport()
    {
        $categories = Category::all();
        $invoice = Invoice::all();
        return view('admin.report.category_wise_report', compact('categories', 'invoice'));
    }


    public function GetCategoryReport(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $category_id = $request->category_id;
        $categories = Category::all();

        if ($start_date && $end_date && $category_id) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $allSearchResult = InvoiceDetail::whereBetween('date', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->where('category_id', $category_id)
                ->get();
        }

        return view('admin.report.category_wise_report_result', compact('categories', 'category_id', 'allSearchResult', 'start_date', 'end_date',));
    }
    
    public function GetCategoryReportSummary(){
        $categories = Category::all();
        return view('admin.report.category_wise_report_summary', compact('categories'));
    }
    
    public function PrintCategorySummary(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $categories = Category::all();
        
        
        if ($start_date && $end_date) {
            $startDate = Carbon::parse($start_date)->toDateTimeString();
            $endDate = Carbon::parse($end_date)->toDateTimeString();
            $allSearchResult = InvoiceDetail::whereBetween('date', [$start_date, Carbon::parse($end_date)->endOfDay()])
                ->get();
        }

        return view('admin.report.category_wise_report_summary_print', compact('allSearchResult', 'categories', 'start_date', 'end_date',));
    }
}
