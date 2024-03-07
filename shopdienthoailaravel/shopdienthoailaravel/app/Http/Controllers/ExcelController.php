<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Excel;
use Illuminate\Http\Request;
use App\Exports\ExcelExports;
use App\Exports\ExportOrder;
use App\Exports\ExportProduct;
use App\Exports\ExportBrand;
use App\Exports\ExportCoupon;
use App\Imports\ImportCategory;
use App\Imports\ImportCoupon;
use App\Imports\ImportBrand;


class ExcelController extends Controller
{
    // CategoryProduct
    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportCategory, $path);
        return back();
    }
    // Brand
    public function export_brand(){
        return Excel::download(new ExportBrand , 'brand.xlsx');
    }
    public function import_brand(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportBrand, $path);
        return back();
    }

    // Manage Order
    public function export_manage_order(){
        return Excel::download(new ExportOrder , 'manageorder.xlsx');
    }
    public function import_manage_order(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new Manageorder , $path);
        return back();
    }

     // Coupon
    public function export_list_coupon(){
        return Excel::download(new ExportCoupon , 'coupon.xlsx');
    }
    public function import_list_coupon(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportCoupon , $path);
        return back();
    }
}
