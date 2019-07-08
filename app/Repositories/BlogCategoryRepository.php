<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\BlogCategory as Model;

/**
 * @package App\Repositonries
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * get editing model (if admin)
     *
     * @param int $id
     * @return Model
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * Get list of existed categories for combobox
     * @return Collection
     */
    public function getForComboBox(){
        return $this->startConditions()->all();
    }

    /**
     * @return string
     */
    protected function getModelClass(){
        return Model::class;
    }
}
