<?php
  
namespace App\Imports;
  

use App\Models\HasilSeleksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;




class DataExport implements FromCollection, WithHeadings,WithColumnWidths
{
    public function collection()
    {
        return HasilSeleksi::all();
        
    }

    public function headings(): array
    {
        return [
            ['No','No_pmb','Nama','Asal_Sekolah','Peringkat_Sekolah','Rata_Rata_Nilai','Rata_Rata_Ipk','Bobot_Akhir'],
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





