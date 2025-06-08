<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BookingDetailsExport implements FromCollection, WithHeadings, WithEvents
{
    protected $periodType;  // 'month' hoặc 'year' hoặc null
    protected $periodValue; // ví dụ: '2025-05' hoặc '2025'

    public function __construct($periodType = null, $periodValue = null)
    {
        $this->periodType = $periodType;
        $this->periodValue = $periodValue;
    }

    public function collection()
    {
        $query = DB::table('booking')
            ->where('BookingStatus', 'Đã trả phòng')
            ->select(
                'BookingID',
                'CustomerName',
                'CheckInDate',
                'CheckOutDate',
                'TotalPrice',
                'BookingStatus',
            );

        if ($this->periodType && $this->periodValue) {
            if ($this->periodType === 'month') {
                // Lọc theo tháng (YYYY-MM)
                $query->whereYear('CheckOutDate', '=', substr($this->periodValue, 0, 4))
                      ->whereMonth('CheckOutDate', '=', substr($this->periodValue, 5, 2));
            } elseif ($this->periodType === 'year') {
                // Lọc theo năm (YYYY)
                $query->whereYear('CheckOutDate', '=', $this->periodValue);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Mã đặt phòng',
            'Tên khách hàng',   
            'Ngày nhận phòng',  
            'Ngày trả phòng',  
            'Tổng tiền',
            'Trạng thái ',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:H1');
                $title = 'BÁO CÁO CHI TIẾT ĐẶT PHÒNG';

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
