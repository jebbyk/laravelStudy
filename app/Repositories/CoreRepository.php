<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @pacage App\Repositories
 *
 * Can't change or add new entityes, Can only give us something
 */

abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model\Illuminate\foundation\Application\mixed
     */
    protected function startConditions(){
        return clone $this->model;
    }
}
