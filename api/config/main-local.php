<?php
return [
	'components' => [
		'request' => [
			'cookieValidationKey' => 'EfVGQz4K8rsKRJzKOkw3SAIP6ZR2u69i',
		],
		'path' => array(
			'class' => 'api\components\Path',
			'real' => 'C:/OSPanel/domains/localhost/test-job/',
			'web' => 'http://www.test-job-api.loc',
		)
	],
	'modules' => [
		'debug' => [
			'class' => 'yii\debug\Module',
		],
	],
	'bootstrap' => ['debug'],
];