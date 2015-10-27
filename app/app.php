<?php
$exedra = require_once __DIR__.'/../exedra';

return $exedra->build(array('name' => 'app', 'namespace' => 'ApiDocs'), function($app)
{
	if($app->loader->has('env.php'))
		$app->config->set($app->loader->load('env.php'));

	$app->registry->addMiddleware(function($exe)
	{
		$exe->view->setDefaultData(array(
			'exe' => $exe
			));

		return $exe->next($exe);
	});

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

					return $exe->view->create('layout', array(
						'apis' => $api,
						'path' => $path,
						'data' => $data
						))->render();
				}
			)
		));
});