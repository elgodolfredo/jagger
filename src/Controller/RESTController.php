<?php
	
	namespace Jagger\Controller;

	class RESTController extends \Framework\Controller
	{

		protected $middlewares = array(array('Middleware\AuthenticateMiddleware'));
		protected $modelName = 'model';
		//redirects
		protected $redirectStore  = '';
		protected $redirectUpdate = '';

		public function show($action)
		{
			$products = $this->service->all();
			$modelsName = $this->modelName . 's';
			$this->render($this->showTemplate, array( $modelsName => $products ));
		}

		public function create($action)
		{	
			$this->render($this->createTemplate);
		}

		public function store($action)
		{
			$this->service->save($action->getInput());
			$this->redirect($this->redirectStore);
		}

		public function edit($action)
		{	
			$params = $action->getParams();
			$product = $this->service->find($params['id']);
			$this->render($this->editTemplate, array( $this->modelName => $product ));
		}

		public function update($action)
		{
			$params = $action->getParams();
			$this->service->update($params['id'], $action->getInput());
			$this->redirect($this->redirectUpdate);
		}

		public function changeOrden($action)
		{
			$params = $action->getParams();
			$this->service->changeOrden($params['id'], $action->getInput());
		}

		public function delete($action)
		{
			$params = $action->getParams();
			$this->service->delete($params['id'], $action->getInput());	
		}

		public function setNoted($action)
		{
			$params = $action->getParams();
			$values = $action->getInput();
			$this->service->setNoted($params['id'], $values['noted'] === 'true');
		}

	}

?>
