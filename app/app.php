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

$app->map['rule']->get('/rule-of-thumbs')->execute(function($exe)
{
	return $exe->layout->set('view', $exe->view->create('rule'))->render();
});

$app->map['error']->requestable(false)->execute(function($exe)
{
	return $exe->layout
	->set('view', $exe->view->create('404')
		->set('exception', $exe->param('exception')))
	->render();
});

$app->map['model']->any('/model')->middleware(function($exe)
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
	})->group(function($models)
	{
		$models['add']->any('/add')->execute('controller=model@add');

		$models['view']->any('/[:model]')->execute('controller=model@view');

		$models['delete']->any('/delete/[:model]')->execute(function($exe)
		{
			$path = realpath($exe->path['app']->file('model/'.$exe->param('model').'.json'));

			unlink($path);

			$exe->flash->set('success', 'model ['.$exe->param('model').'] has been deleted.');

			return $exe->redirect->route('add');
		});

		$models['edit']->any('/edit/[:model]')->execute('controller=model@edit');
	});

$app->map['spec']->get('/[:path?]')->execute(function($exe)
{
	$api = json_decode($exe->path['app']->getContents('data/index.json'), true);

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
});

return $app;
