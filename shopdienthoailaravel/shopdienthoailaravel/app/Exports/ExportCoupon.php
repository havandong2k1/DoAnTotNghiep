<?php

namespace App\Exports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class ExportCoupon implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.coupon', [
            'coupon' => Coupon::all()
        ]);
    }
}
