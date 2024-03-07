<?php

namespace App\Exports;
use App\Models\CategoryProductModels;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\registerEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;


class ExcelExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return CategoryProduct::all();
    // }
    public function view(): View
    {
        return view('exports.categoryproduct', [
            'category' => CategoryProductModels::all()
        ]);
    }
    //   public function columnWidths(): array
    // {
    //     return [
    //         'Từ khóa' => 30,
    //         'Tên danh mục' => 30,
    //         'Slug' => 30,
    //         'Mô tả' => 30,
    //         'Trạng thái' => 20,
    //     ];
    // }
    // public function headings(): array {
    //     return [
    //         'Từ khóa',
    //         'Tên danh mục',
    //         'Slug',    
    //         'Mô tả',
    //         'Trạng thái'
            
    //     ];
    // }
  
    // public function map($category): array {
    //     return [
    //         $category->meta_keywords,
    //         $category->category_name,
    //         $category->slug_category_product,
    //         $category->category_desc,
    //         $category->category_status
    //     ];
    // }
}
