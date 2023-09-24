<?php

namespace App\Imports;

use App\Models\SpamWords;
use Maatwebsite\Excel\Concerns\ToModel;

class SpamWordsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0]){
        $old = SpamWords::where('name',$row[0])->first();
        if(!$old){
            return new SpamWords([
                'name'=>$row[0]
            ]);
        }
    }
        
    }
}
