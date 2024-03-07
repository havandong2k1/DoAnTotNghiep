<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class ExportBrand implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.brand', [
            'brand' => Brand::all()
        ]);
    }
}
