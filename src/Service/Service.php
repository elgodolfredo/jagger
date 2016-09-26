<?php  
	
	namespace Jagger\Service;

	class Service
	{

		protected function filterOptions($options=array())
		{
			return array('deleted' => false);
		}

		public function allToShow($params=array())
		{
			$modelClass = $this->getModelClass();
			$options = array_merge(array('noted' => true), $this->filterOptions());
			return $modelClass::where($options)->orderBy('orden')->get();
		}

		public function all($params=array())
		{
			$modelClass = $this->getModelClass();
			return $modelClass::where($this->filterOptions())->orderBy('orden')->get();
		}

		protected function allGtOrden($model)
		{
			$modelClass = $this->getModelClass();
			return $modelClass::where($this->filterOptions())->where('orden', '>', $model->orden)->get();
		}

		protected function getOrderFilterOptions($values, $model)
		{
			return array_merge(array('orden' => $values['orden']), $this->filterOptions());
		}

		public function find($id)
		{
			$modelClass = $this->getModelClass();
			return $modelClass::findOrFail($id);
		}

		public function where($values)
		{
			$modelClass = $this->getModelClass();
			return $modelClass::where($values);
		}

		public function save($values)
		{
			$modelClass = $this->getModelClass();
			$model = new $modelClass();
			$this->setValues($model, $values);
			$model->orden = $this->getOrden($values);
			$model->save();
		}

		public function update($id, $values)
		{
			$modelClass = $this->getModelClass();
			$model = $modelClass::findOrFail($id);
			$this->setValues($model, $values);
			$model->save();
		}

		public function delete($id, $values)
		{
			$modelClass = $this->getModelClass();
			$model = $modelClass::findOrFail($id);
			$model->deleted = true;
			$model->save();
			$models = $this->allGtOrden($model);
			foreach ($models as $model) {
				$model->orden = $model->orden - 1;
				$model->save();
			}
		}

		public function getOrden($values)
		{
			$modelClass = $this->getModelClass();
			return $modelClass::where($this->filterOptions())->count() + 1;
		}

		public function changeOrden($id, $values)
		{
			$model = $this->find($id);
			$oldOrden = $model->orden;
			$model->orden = $values['orden'];
			$filterOptions = $this->getOrderFilterOptions($values, $model);
			$sameOrden = $this->where($filterOptions)->first();
			if ( $sameOrden )
			{
				$sameOrden->orden = $oldOrden;
				$sameOrden->save();
			}
			$model->save();
		}

		public function setNoted($id, $noted)
		{
			$model = $this->find($id);
			$model->noted = $noted;
			$model->save();
		}

	}


?>