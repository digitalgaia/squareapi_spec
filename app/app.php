<?php
require_once __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL & ~E_NOTICE);

session_start();

$app = new \Exedra\Application(__DIR__.'/../');

if($app->path['app']->has('env.php'))
	$app->config->set($app->path['app']->load('env.php'));

$app->map->middleware(function($exe)
{
	$exe->view->setDefaultData(array(
		'exe' => $exe
		));

	$exe->layout = $exe->view->create('layout');

	try
	{
		return $exe->next($exe);
	}
	catch(\Exception $e)
	{
		return $exe->execute('@error', array('exception' => $e));
	}
});

$app->map->addRoutes(array(
	'rule' => array(
		'path' => '/rule-of-thumbs',
		'execute' => function($exe)
		{
			return $exe->layout->set('view', $exe->view->create('rule'))->render();
		}
		),
	'error' => array(
		'path' => false,
		'execute' => function($exe)
		{
			return $exe->layout
			->set('view', $exe->view->create('404')
				->set('exception', $exe->param('exception')))
			->render();
		}),
	'model' => array(
		'path' => '/model',
		'middleware' => function($exe)
		{
			$path = $exe->path['app']->path('model');

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

			if(!is_array($response))
				return $response;

			return $exe->layout->set('view', $exe->view->create('model', array(
				'models' => $models,
				'view' => $response['view'],
				'data' => $response['data']
				)))->render();
		},
		'subroutes' => array(
			'add' => array(
				'path' => '/add',
				'execute' => 'controller=model@add'
				),
			'view' => array(
				'path' => '/[:model]',
				'execute' => 'controller=model@view'
				),
			'delete'=> array(
				'path' => '/delete/[:model]',
				'execute' => function($exe)
				{
					$path = realpath($exe->path['app']->file('model/'.$exe->param('model').'.json'));

					unlink($path);

					return $exe->redirect->flash('success', 'model ['.$exe->param('model').'] has been deleted.')->route('add');
				}),
			'edit' => array(
				'path' => '/edit/[:model]',
				'execute' => 'controller=model@edit'
				)
			)
		)
	));

$app->map->addRoutes(array(
	'spec' => array(
		'path' => '/[:path?]',
		'execute' => function($exe)
			{
				$api = json_decode($exe->path['app']->getContent('data/index.json'), true);

				$path = $exe->param('path');

				if($path)
				{
					if($exe->path['app']->isExists($file = 'data/'.$path.'.json'))
					{
						$data = json_decode($exe->path['app']->getContents($file), true);
					}
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

return $app;
