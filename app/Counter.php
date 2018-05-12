<?php

namespace App;

use Moloquent;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use DB;

class Counter extends Moloquent
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'counter';

    public function generateSO($id) {
        $counter = DB::collection('counter')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ] 
            ]);
            return $collection->seq;
        });
        return $counter;
    }

    public function generateClient($id) {
        $counter = DB::collection('counter')->raw(function($collection) use ($id){
            $collection = $collection->findOneAndUpdate([
                '_id' => $id],
                [ '$inc' => [ 'seq' => 1 ] 
            ]);
            return $collection->seq;
        });
        return $counter;
    }
}
