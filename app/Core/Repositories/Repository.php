<?php

namespace App\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $model
 */
abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }


    public function makeModel()
    {
        $this->checkPropertyModel();

        $model = $this->checkInstanceOf();

        $this->setModel($model);
    }

    public function checkPropertyModel()
    {
        if (! property_exists($this, 'model')) {
            throw new Exception('Class' . get_class($this).' must provide an attribute called \'model\'');
        }
    }

    public function checkInstanceOf()
    {
        $model = app($this->model);

        if ($model instanceof Model) {
            return $model;
        }

        throw new Exception($this->model . ' must be an instance of Illuminate\\Database\\Eloquent\\Model');
    }

    protected function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function all(array $column = ['*'])
    {
        return $this->model->all($column);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrFail($value, $column = 'id')
    {
        $post = $this->model->where($column, $value)->first();

        return collect($post)->isNotEmpty() ? $post : abort(404);
    }
}
