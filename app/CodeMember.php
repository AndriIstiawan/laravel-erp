<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use DB;

class CodeMember extends Moloquent
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'codemembers';

    public function generateSO($id) {
        $codemember = DB::collection('codemembers')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ] 
            ]);
            return $collection->seq;
        });
        return $codemember;
    }
}
