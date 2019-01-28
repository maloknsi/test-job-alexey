<?php

namespace api\modules\v1\controllers;

use api\components\Controller;
use api\models\User;
use common\traits\access\Allow;
use yii\bootstrap\ActiveForm;

/**
 * Class AuthController
 * @package api\modules\v1\controllers
 */
class UserController extends Controller
{

	use Allow;

	/**
	 * @inheritdoc
	 * @return array список дозволених методів
	 */
	public function verbs()
	{
		return [
			'login' => ['post'],
			'register' => ['post'],
		];
	}

	/**
	 * Дозвіл доступу для неавторизованих користувачів
	 *
	 * @return array список правил
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		unset($behaviors['authenticator']);
		return $behaviors;
	}

	/**
	 * Получение СМС с кодом для авторизации, авторизация по коду
	 * @return array
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionLogin()
	{
		$return = [];
		$error = '';
		$phone = \Yii::$app->request->post('tel_phone');
		$password = \Yii::$app->request->post('password');
		$smsCode = \Yii::$app->request->post('code');

		$phone = ltrim(str_replace("+", "", $phone));
		if ($phone && $password) {
			if ($user = User::findByPhone($phone)) {
				if ($user->validatePassword($password)) {
					$return['status'] = 1;
					if ($smsCode) {
						if ($user->sms_code && $user->sms_code == $smsCode) {
							$return['status'] = 1;
							$user->sms_code = null;
							$user->generateAccessToken(true); // 'auth_key'
							$return['access_token'] = $user->user_auth_token;
						} else {
							$return['status'] = 0;
							$return['message'] = "Введенный sms-код не правильный";
						}
					} else {
						$user->generateSmsCode();
						$return['message'] = "На номер телефона {$phone} выслана sms с кодом";
					}
				} else {
					$error = 'Неправильный пароль';
				}
			} else {
				$error = 'Номер телефона не найден, пожалуйста введите правильный номер.';
			}
		} else {
			$error = 'Введите номер телефона и пароль';
		}
		if ($error) {
			$return['status'] = 0;
			$return['message'] = $error;
		}
		return $return;
	}

	/**
	 * Регистрация нового пользователя
	 * @return array
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionRegister()
	{
		$return = [];
		$postData = \Yii::$app->request->post();
		foreach ($postData as $key => $value)
			if (!in_array($key, ['firstName', 'lastName', 'middleName', 'phone', 'new_password',
				'birthDate', 'logo', 'city', 'address', 'email', 'username'])
			) unset($postData[$key]);
		$postData['fullName'] = $postData['firstName'] . " " . $postData['lastName']. " "  . $postData['middleName'];
		$postData['created_at'] = time();
		$postData['updated_at'] = time();
		$postData['role'] = User::ROLE_USER;
		$user = new User();
		if ($user->load($postData, '') && $user->save()) {
			$return['status'] = 1;
			$user->generateAccessToken(true);
			$return['access_token'] = $user->user_auth_token;
		} else {
			$return['status'] = 0;
			$return['message'] = ActiveForm::validate($user);
		}
		return $return;
	}
}
