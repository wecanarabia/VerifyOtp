<?php

namespace App\Traits;

use App\Models\PointRecord;
use App\Repositories\Repository;

trait PointRecordTrait{
    public function record($message,$points,$userId){
        $recordPoint = new Repository(app(PointRecord::class));
        $recordPoint->save(['message'=>$message,'points'=>$points,'user_id'=>$userId]);
        return $recordPoint;
    }
}
