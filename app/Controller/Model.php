<?php
namespace App\Controller;

class Model
{
	public function __construct($exe)
	{
		$this->exe = $exe;
	}

	public function view()
	{
		$model = $this->exe->param('model');

		$model = json_decode($this->exe->path['app']->getContents('model/'.$model.'.json'), true);

		return array(
			'view' => 'model.view',
			'data' => $model);
	}

	public function edit()
	{
		$model = $this->exe->param('model');

		$model = json_decode($this->exe->path['app']->getContents('model/'.$model.'.json'), true);

		$request = $this->exe->request;
		$path = $this->exe->path;
		$modelList = $this->exe->modelList;

		$this->exe->form->setOption('data[type][]', array(
			'string' => 'string',
			'integer' => 'integer',
			'float' => 'float',
			'boolean' => 'boolean'));

		if($request->getMethod() == 'POST')
		{
			$post = $request->param();

			/*if(in_array($post['name'], $modelList))
			{
				$this->exe->flash->set('error', 'Unable to add.');
				$this->exe->redirect->to('@model.edit', array('model' => $model['name']));
			}*/

			// prepare relation data.
			$relations = array();
			foreach($post['relation']['model'] as $no => $record)
			{
				$model = $post['relation']['model'][$no];
				$type = $post['relation']['type'][$no];

				if(!$model)
					continue;

				$relations[$no]['model'] = $modelList[$model];
				$relations[$no]['type'] = $type;
			}

			$post['relation'] = $relations;

			// prepare model data
			$datas = $post['data'];
			$newDatas = array();

			foreach($datas['name'] as $no => $record)
			{
				$name = $datas['name'][$no];
				$description = $datas['description'][$no];
				$type = $datas['type'][$no];
				$required = $datas['required'][$no];

				$newDatas[$no] = array(
					'name' => $name,
					'description' => $description,
					'type' => $type,
					'required' => $required == 'on' ? true : false
					);
			}

			$post['data'] = $newDatas;
			$data = $post;

			$path = $path->create('model/'.$data['name'].'.json');

			$data = json_encode($data, JSON_PRETTY_PRINT);



			// save.
			file_put_contents($path->toString(), $data);

			return $this->exe
			->redirect
			->flash('success', 'Updated!')
			->refresh();
		}

		$this->exe->form->set(array(
			'description' => $model['description']
			));

		return array(
			'view' => 'model.edit',
			'data' => $model);
	}

	public function add()
	{
		$request = $this->exe->request;
		$path = $this->exe->path;
		$modelList = $this->exe->modelList;

		$this->exe->form->setOption('data[type][]', array(
			'string' => 'string',
			'integer' => 'integer',
			'float' => 'float',
			'boolean' => 'boolean'));

		$this->exe->form->set('data[type][]', 'string');

		if($request->getMethod() == 'POST')
		{
			$post = $request->getParsedBody();

			if(in_array($post['name'], $modelList))
			{
				$this->exe->flash->set('error', 'Unable to add.');
				$this->exe->redirect->to('@model.add');
			}

			// prepare relation data.
			$relations = array();
			foreach($post['relation']['model'] as $no => $record)
			{
				$model = $post['relation']['model'][$no];
				$type = $post['relation']['type'][$no];

				if(!$model)
					continue;

				$relations[$no]['model'] = $modelList[$model];
				$relations[$no]['type'] = $type;
			}

			$post['relation'] = $relations;

			// prepare model data
			$datas = $post['data'];
			$newDatas = array();

			foreach($datas['name'] as $no => $record)
			{
				$name = $datas['name'][$no];
				$description = $datas['description'][$no];
				$type = $datas['type'][$no];
				$required = $datas['required'][$no];

				$newDatas[$no] = array(
					'name' => $name,
					'description' => $description,
					'type' => $type,
					'required' => $required == 'on' ? true : false
					);
			}

			$post['data'] = $newDatas;
			$data = $post;

			$path = $path['app']->path('model/'.$data['name'].'.json');

			$data = json_encode($data, JSON_PRETTY_PRINT);

			// save.
			file_put_contents($path, $data);

			return $this->exe
			->redirect
			->flash('success', 'New model added!')
			->route('view', array('model' => $post['name']));
		}

		return array(
			'view' => 'model.add',
			'data' => array());
	}
}