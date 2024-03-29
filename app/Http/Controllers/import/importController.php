<?php

namespace App\Http\Controllers\import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class importController implements ToCollection
{
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
