<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AppointmentDetailsExport implements FromCollection, WithHeadings, WithEvents
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
        $query = DB::table('appointments as a')
            ->join('services as s', 'a.ServiceID', '=', 's.ServiceID')
            ->select(
                'a.AppointmentID',
                'a.CustomerName',
                'a.ServiceID',
                's.ServiceName as service_name',
                'a.CustomerContact',
                'a.LocationName',
                's.Price',
                'a.AppointmentDate'
            );

        if ($this->periodType && $this->periodValue) {
            if ($this->periodType === 'month') {
                $query->whereYear('a.AppointmentDate', '=', substr($this->periodValue, 0, 4))
                    ->whereMonth('a.AppointmentDate', '=', substr($this->periodValue, 5, 2));
            } elseif ($this->periodType === 'year') {
                $query->whereYear('a.AppointmentDate', '=', $this->periodValue);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Mã lịch hẹn',
            'Tên khách hàng',
            'Mã dịch vụ',
            'Tên dịch vụ',
            'Liên hệ khách hàng',
            'Địa điểm',
            'Gía',
            'Ngày hẹn'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:L1');
                $title = 'BÁO CÁO CHI TIẾT DỊCH VỤ';

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
                $event->sheet->getRowDimension(1)->setRowHeight(30);
                $event->sheet->getStyle('A3:L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A3:L3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $event->sheet->getStyle('A3:L3')->getFill()->getStartColor()->setARGB('FFE5E5E5');
            },
        ];
    }
}
