<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
          'matric_number'=> $row[0],
           'name' => $row[1],
           'field' => $row[2],
           'university_id' => $row[3],
           'rector_id' => $row[4],
           'faculty_id' => $row[5],
           'dean_id' => $row[6],
           'department_id' => $row[7],
           'template_id' => $row[8],
           
        ]);
    }
}
