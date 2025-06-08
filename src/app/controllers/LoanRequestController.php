<?php

namespace app\controllers;

use app\jobs\LoanProcessJob;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\models\LoanRequest;

class LoanRequestController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionCreate(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = json_decode(Yii::$app->request->getRawBody(), true);

        if (!isset($data['user_id'], $data['amount'], $data['term'])) {
            Yii::$app->response->statusCode = 400;
            return ['result' => false];
        }

        $hasApproved = LoanRequest::find()
            ->where(['user_id' => $data['user_id'], 'status' => 'approved'])
            ->exists();

        if ($hasApproved) {
            Yii::$app->response->statusCode = 400;
            return ['result' => false];
        }

        $model = new LoanRequest([
            'user_id' => $data['user_id'],
            'amount' => $data['amount'],
            'term' => $data['term'],
            'status' => null,
        ]);

        if ($model->save()) {
            Yii::$app->response->statusCode = 201;
            return ['result' => true, 'id' => $model->id];
        }

        Yii::$app->response->statusCode = 400;
        return ['result' => false];
    }

    public function actionProcess($delay = 1): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requests = LoanRequest::find()->where(['status' => null])->all();
        foreach ($requests as $request) {
            Yii::$app->queue->push(
                new LoanProcessJob([
                    'requestId' => $request->id,
                    'delay' => (int)$delay,
                ])
            );
        }

        return ['result' => true];
    }
}
