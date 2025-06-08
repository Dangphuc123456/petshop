<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PurchaseOrderDetailsExport implements FromCollection, WithHeadings, WithEvents
{
    protected $periodType;
    protected $periodValue;

    /**
     * @param string|null $periodType  (ví dụ: 'month' hoặc 'year')
     * @param string|null $periodValue (ví dụ: '2025-06' hoặc '2025')
     */
    public function __construct($periodType = null, $periodValue = null)
    {
        $this->periodType  = $periodType;
        $this->periodValue = $periodValue;
    }

    /**
     * Trả về collection dữ liệu để viết vào Excel
     */
    public function collection()
    {
        $query = DB::table('purchase_orders as po')
            ->join('suppliers as sp', 'po.supplier_id', '=', 'sp.supplier_id')
            ->join('purchase_order_items as poi', 'po.purchase_order_id', '=', 'poi.purchase_order_id')
            ->leftJoin('pets as p', 'poi.pet_id', '=', 'p.pet_id')
            ->select(
                'po.purchase_order_id',
                'sp.name as supplier_name',        // sửa lại thành 'sp.name'
                'po.order_date',
                'po.total_amount',
                'poi.pet_id',
                'p.description as pet_name',
                'poi.quantity',
                'poi.price as unit_price'
            )
            ->whereNotNull('po.purchase_order_id');

        if ($this->periodType && $this->periodValue) {
            if ($this->periodType === 'month') {
                $year  = substr($this->periodValue, 0, 4);
                $month = substr($this->periodValue, 5, 2);
                $query->whereYear('po.order_date', $year)
                      ->whereMonth('po.order_date', $month);
            } elseif ($this->periodType === 'year') {
                $query->whereYear('po.order_date', $this->periodValue);
            }
        }

        return $query->get();
    }

    /**
     * Tiêu đề cột trong Excel
     */
    public function headings(): array
    {
        return [
            'Mã phiếu nhập',
            'Tên nhà cung cấp',
            'Ngày đặt',
            'Tổng tiền (VND)',
            'Mã thú cưng',
            'Tên thú cưng',
            'Số lượng',
            'Giá nhập (VND)',
        ];
    }

    /**
     * Định dạng tiêu đề, merge cell, styling...
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Chèn 2 dòng trống trước header
                $event->sheet->insertNewRowBefore(1, 2);

                // Merge tiêu đề qua tất cả cột A→H (8 cột)
                $event->sheet->mergeCells('A1:H1');

                // Xây dựng chuỗi tiêu đề động
                $title = 'BÁO CÁO CHI TIẾT PHIẾU NHẬP';

                if ($this->periodType && $this->periodValue) {
                    if ($this->periodType === 'month') {
                        $month = intval(substr($this->periodValue, 5, 2));
                        $year  = substr($this->periodValue, 0, 4);
                        $title .= ' - Tháng ' . $month . ' Năm ' . $year;
                    } elseif ($this->periodType === 'year') {
                        $title .= ' - Năm ' . $this->periodValue;
                    }
                }

                // Ghi tiêu đề vào A1
                $event->sheet->setCellValue('A1', $title);

                // Style cho A1
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getRowDimension(1)->setRowHeight(30);

                // Style cho header Row (dòng 3)
                $event->sheet->getStyle('A3:H3')->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A3:H3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE5E5E5');
            },
        ];
    }
}
