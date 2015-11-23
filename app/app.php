<?php
$exedra = require_once __DIR__.'/../exedra';

error_reporting(E_ALL & ~E_NOTICE);
return $exedra->build(array('name' => 'app', 'namespace' => 'ApiDocs'), function($app)
{
	if($app->loader->has('env.php'))
		$app->config->set($app->loader->load('env.php'));

	$app->registry->addMiddleware(function($exe)
	{
		$exe->view->setDefaultData(array(
			'exe' => $exe
			));

		$exe->layout = $layout = $exe->view->create('layout');

		return $exe->next($exe);
	});

	$app->map->addRoutes(array(
		'rule' => array(
			'uri' => 'rule-of-thumbs',
			'execute' => function($exe)
			{
				return $exe->layout->set('view', $exe->view->create('rule'));
			}
			),
		'model' => array(
			'uri' => 'model',
			'middleware' => function($exe)
			{
				$path = $exe->path->create('model')->toString();

				$dir = opendir($path);

				$models = array();
				while(($file = readdir($dir)) !== false)
				{
					if(strpos($file, '.json') === false)
						continue;

					$model = str_replace('.json', '', $file);
					$models[$model] = $model;
				}

				$exe->modelList = $models;

				$response = $exe->next($exe);

				if(is_string($response))
					return $response;

				return $exe->layout->set('view', $exe->view->create('model', array(
					'models' => $models,
					'view' => $response['view'],
					'data' => $response['data']
					)))->render();
			},
			'subroutes' => array(
				'add' => array(
					'uri' => 'add',
					'execute' => 'controller=model@add'
					),
				'view' => array(
					'uri' => '[:model]',
					'execute' => 'controller=model@view'
					),
				'edit' => array(
					'uri' => 'edit/[:model]',
					'execute' => 'controller=model@edit'
					)
				)
			)
		));

	$app->map->addRoutes(array(
		'spec' => array(
			'uri' => '[:path?]',
			'execute' => function($exe)
				{
					$api = json_decode($exe->loader->getContent('data/index.json'), true);

					$path = $exe->param('path');

					if($path)
					{
						if($exe->loader->has($file = 'data/'.$path.'.json'))
							$data = json_decode($exe->loader->getContent($file), true);
					}

					return $exe->layout
					->set('view', $exe->view->create('api', array(
						'apis' => $api,
						'path' => $path,
						'data' => $data
						)))->render();
				}
			)
		));
});