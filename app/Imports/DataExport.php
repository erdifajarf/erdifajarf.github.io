<?php
  
namespace App\Imports;
  

use App\Models\HasilSeleksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;







class DataExport implements FromCollection, WithHeadings,WithColumnWidths,WithStyles
{
    public function collection()
    {
        return HasilSeleksi::all();
        
    }

    public function headings(): array
    {
        return [
            ['No','No.PMB','Nama','Asal Sekolah','Peringkat Sekolah','Rata-Rata Nilai','Rata-Rata Ipk','Bobot Akhir (AHP)'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            'A1'  => ['font' => ['bold' => true,'size' => 12]],
            'B1'  => ['font' => ['bold' => true,'size' => 12]],
            'C1'  => ['font' => ['bold' => true,'size' => 12]],
            'D1'  => ['font' => ['bold' => true,'size' => 12]],
            'E1'  => ['font' => ['bold' => true,'size' => 12]],
            'F1'  => ['font' => ['bold' => true,'size' => 12]],
            'G1'  => ['font' => ['bold' => true,'size' => 12]],
            'H1'  => ['font' => ['bold' => true,'size' => 12]],

        ];

    }


    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,       
            'C' => 35,
            'D' => 50,
            'E' => 20,       
            'F' => 20,
            'G' => 20,  
            'H' => 20,               
        ];
    }

}





