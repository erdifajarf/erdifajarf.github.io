<?php
  
namespace App\Exports;
  
use App\Models\Siswa;
use App\Models\Sekolah;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }
}