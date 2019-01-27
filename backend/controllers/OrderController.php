<?php

namespace backend\controllers;

use backend\components\CController;
use backend\models\OrderSearch;
use common\models\Order;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends CController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return
			ArrayHelper::merge(
			[
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['index'],
							'allow' => true,
							'roles' => ['moderator'],
						],
					],
				],
				[
					'class' => 'yii\filters\AjaxFilter',
					'only' => ['edit', 'validate', 'save', 'delete'],
					'errorMessage' => 'Ошибка типа запорса (AJAX ONLY!)',
				],
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['post'],
					],
				],
			],
				parent::behaviors()
			);
	}


	public function getNewModel($isModelSearch = false)
	{
		return $isModelSearch ? new OrderSearch() : new Order();
	}

	/**
	 * Finds the Order model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Order the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Order::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
