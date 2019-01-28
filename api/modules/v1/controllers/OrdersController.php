<?php

namespace api\modules\v1\controllers;


use api\models\User;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\auth\QueryParamAuth;
use api\models\Orders;

class OrdersController extends ActiveController
{


    public $modelClass = 'api\modules\v1\models\Orders';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'access_token'
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['GET'],
                'create' => ['POST'],
                'details' => ['GET'],
            ],
        ];
        return $behaviors;
    }


    public function verbs()
    {
        return [
            'index' => ['GET'],
            'create' => ['POST'],
            'details' => ['GET'],
        ];
    }


    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create']);
        return $actions;
    }


    public function actionIndex()
    {
        $access_token = \Yii::$app->request->get('access_token');
        $modelUser = User::findOne(['user_auth_token' => $access_token]);
        $userId = $modelUser->id;
        $query = Orders::find()->select(['id', 'date_issue', 'status'])->where(['user_id' => $userId]);
        $count = $query->count();
        $limit = 3;
        $pages = ceil($count / $limit);
        $page = \Yii::$app->request->get('page', 1);
        $offset = $limit * ($page - 1);
        $orders = $query->offset($offset)
            ->limit($limit)
            ->orderBy('id DESC')
            ->all();
        return [
            'orders' => $orders,
            'pages' => (int) $pages,
            'page' => (int) $page,
            'count' => (int) $count,
            'offset' => $offset,
            'limit' => $limit
        ];
    }


    public function actionCreate($access_token)
    {
        $post = \Yii::$app->request->post();
        $user = User::findOne(['user_auth_token' => $access_token]);
        $order = new Orders();
        $order->user_id = $user->id;
        if ($order->load($post, '') && $order->validate()) {
            $order->save(false);
            return $order;
        } else {
            return $order->errors;
        }
    }


       public function actionDetails()
    {
        $access_token = \Yii::$app->request->get('access_token');
        $orderId = \Yii::$app->request->get('order_id');

        $user = User::findOne(['user_auth_token' => $access_token]);
        $order = Orders::findOne(['id' => $orderId, 'user_id' => $user->id]);

        return $order;
    }
}
