<?php

namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use app\models\LoanRequest;

class LoanProcessJob extends BaseObject implements JobInterface
{
    public int $requestId;
    public int $delay;

    public function execute($queue): void
    {
        sleep($this->delay);

        $request = LoanRequest::findOne($this->requestId);
        if (!$request || $request->status !== null) {
            return;
        }

        $hasApproved = LoanRequest::find()
            ->where(['user_id' => $request->user_id, 'status' => 'approved'])
            ->exists();

        $request->status = $hasApproved ? 'declined' : ((random_int(1, 10) === 1) ? 'approved' : 'declined');
        $request->save(false);
    }
}
