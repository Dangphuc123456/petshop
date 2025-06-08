<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderDetailsExport implements FromCollection, WithHeadings, WithEvents
{
    protected $periodType;
    protected $periodValue;

    public function __construct($periodType = null, $periodValue = null)
    {
        $this->periodType = $periodType;
        $this->periodValue = $periodValue;
    }

    public function collection()
    {
        $query = DB::table('orders as o')
            ->join('order_items as oi', 'o.order_id', '=', 'oi.order_id')
            ->where('o.status', 'Hoàn thành')
            ->select(
                'o.order_id',
                'o.customer_name',
                'o.phone',
                'o.email',
                'o.address',
                'o.country',
                'o.postal_code',
                'o.payment',
                'o.status',
                'o.order_date',
                'o.total_amount',
                'oi.pet_id',
                'oi.quantity',
                'oi.price',
                'oi.description'
            );

        // Phần lọc theo tháng/năm sẽ không chạy vì dd() đã dừng
        if ($this->periodType && $this->periodValue) {
            if ($this->periodType === 'month') {
                $year  = substr($this->periodValue, 0, 4);
                $month = substr($this->periodValue, 5, 2);
                $query->whereYear('o.order_date', $year)
                    ->whereMonth('o.order_date', $month);
            } elseif ($this->periodType === 'year') {
                $query->whereYear('o.order_date', $this->periodValue);
            }
        }

        return $query->get();
    }


    public function headings(): array
    {
        return [
            'Mã hóa đơn',
            'Tên khách hàng',
            'SĐT',
            'Email',
            'Địa chỉ',
            'Quốc gia',
            'Mã bưu chính',
            'Phương thức thanh toán',
            'Trạng thái',
            'Ngày đặt',
            'Tổng tiền',
            'Mã sản phẩm',
            'Số lượng',
            'Gía sản phẩm',
            'Tên sản phẩm',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:R1');
                $title = 'BÁO CÁO CHI TIẾT ĐƠN HÀNG';

                if ($this->periodType && $this->periodValue) {
                    if ($this->periodType === 'month') {
                        $month = substr($this->periodValue, 5, 2);
                        $year = substr($this->periodValue, 0, 4);
                        $title .= ' - Tháng ' . intval($month) . ' Năm ' . $year;
                    } elseif ($this->periodType === 'year') {
                        $title .= ' - Năm ' . $this->periodValue;
                    }
                }

                $event->sheet->setCellValue('A1', $title);
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
