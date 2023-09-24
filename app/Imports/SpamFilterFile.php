<?php

namespace App\Imports;

use App\Models\SpamWords;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SpamFilterFile implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function collection(array $row)
    {
       
        return new SpamWords([
            'name'     => $row['name'],
            'email'    => $row['email'],
        ]);
         
         
    }
}
