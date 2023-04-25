<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CoursesImport implements ToCollection
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $emp = new Employee([
    //        'name'     => $row[0],
    //        'email'    => $row[3], 
    //        'location' => $row[5],
    //     ]);
    //     $user->save();

    // }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            //dd($row);
            // echo $row[];
            if($row[0]!=null){

                //$reader->formatDates(true);
                 //echo "-----";
                $obj = new Course();

                $obj->Course_code = $row[0] ;
                //echo $row[0]." ";
                $obj->Name = $row[1];
                //echo $row[1]." ";
              
                //echo $row[3]." ";
              //$bd =  Carbon::parse("$row[4]")->format('Y/m/d');
                ///$obj->birth_date =  $row[4];
                $obj->Semester = $row[2];
                //$date = Date::excelToDateTimeObject($d)->format('Y-m-d');
                //$obj->dob =  $date;
                //echo $date." ";
                $obj->Credit =$row[3];
                $obj->Student_limit =$row[4];
                $obj->Hour= $row[5];
                //echo $row[4]." ";
                $obj->Type =$row[6];
                //echo $row[5]." ";
              
               
               
             
        
                //echo "<br>";
                $obj->save();
            }
            
        }
       
    }
}
