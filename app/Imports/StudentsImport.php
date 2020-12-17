<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\PreImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToModel, WithBatchInserts, WithChunkReading, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!isset($row['matric_no'])) return null;
        if(!isset($row['name'])) return null;
        if(!isset($row['faculty'])){
            if(!isset($row['kulliyyah'])){
                return null;
            }
        }
        if(!isset($row['programme'])) return null;
        if(!isset($row['citizenship'])) return null;
        if(!isset($row['serial_no'])) return null;
        if(!isset($row['date_endorse'])) return null;

        $date = Date::excelToDateTimeObject($row['date_endorse']);

        return new PreImport([
            'matric_no'     => $row['matric_no'] ?? $row['matrik_no'] ?? $row['matric_number'] ?? $row['nombor_matrik'] ?? $row['matric_num'],
            'name'          => $row['name'] ?? $row['nama'],
            'faculty'       => $row['faculty'] ?? $row['faculti'] ?? $row['fakulty'] ?? $row['fakulti'] ?? $row['kulliyyah'] ?? $row['kuliyyah'] ?? $row['kuliyah'] ?? $row['kulliyah'] ,
            'programme'     => $row['programme'] ?? $row['program'] ?? $row['bachelor'] ?? $row['major'],
            'citizenship'   => $row['citizenship'] ?? $row['nationality'],
            'serial_no'     => $row['serial_no'],
            'date_endorse'  => Carbon::parse($date),
            'university_id' => auth()->user()->university->id,
        ]);
    }

    public function batchSize() : int
    {
        return 1000;
    }

    public function chunkSize() : int
    {
        return 5000;
    }

    public function startRow(): int
    {
        return 2;
    }
}
