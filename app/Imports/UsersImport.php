<?php

namespace App\Imports;

namespace App\Imports;

use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            //dd($row);
            // echo $row[];
            if($row[0]!=null){

                //$reader->formatDates(true);
                 //echo "-----";
                $obj = new Student();

                $obj->name = $row[0] ;
               // echo $row[0]." ";
                $obj->email = $row[1];
                //echo $row[1]." ";
               
               
              //$bd =  Carbon::parse("$row[4]")->format('Y/m/d');
                ///$obj->birth_date =  $row[4];
                $d = (double)$row[3];
                $date = Date::excelToDateTimeObject($d)->format('Y-m-d');
                $obj->birth_date =  $date;
                //echo $date." ";
                $obj->address =$row[4];
                 //echo $row[4]." ";

                $obj->img =$row[5];
                //echo $row[5]." ";
            
                //echo "<br>";
                $obj->save();
            }
            
        }
       
    }
}
