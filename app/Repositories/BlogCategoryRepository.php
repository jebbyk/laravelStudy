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
        //return $this->startConditions()->all();

        $fields = implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title']);

       /* $result[] = $this->startConditions()()->all();*/

        /*$result[] = $this
        ->startConditions()
        ->select('blog_categories.*', \DB::raw('CONCAT (id, ". ", title) AS id_title'))
        ->toBase()
        ->get();*/

        $result = $this
        ->startConditions()
        ->selectRaw($fields)
        ->toBase()
        ->get();

        return $result;
    }

    public function getAllWithPaginate($perPage = null)
    {
        $fields = ['id', 'title', 'parent_id'];

        $result = $this
        ->startConditions()
        ->select($fields)
        ->paginate($perPage);

        return $result;
    }

    /**
     * @return string
     */
    protected function getModelClass(){
        return Model::class;
    }
}
