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
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToModel, WithBatchInserts, WithChunkReading, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = Date::excelToDateTimeObject($row[6]);

        return new PreImport([
            'matric_no'     => $row[0],
            'name'          => $row[1],
            'faculty'       => $row[2],
            'programme'     => $row[3],
            'citizenship'   => $row[4],
            'serial_no'     => $row[5],
            'date_endorse'  => Carbon::parse($date),
            'user_id'       => Auth::id(),
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
