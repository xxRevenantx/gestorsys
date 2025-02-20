<?php

namespace App\Exports;

use App\Models\Tutor;
use Maatwebsite\Excel\Concerns\FromCollection;

class TutorExport implements FromCollection
{
    public $tutors;

    public function __construct($tutors)
    {
        $this->tutors = $tutors;
    }

    public function collection()
    {
        return $this->tutors;
    }
}
