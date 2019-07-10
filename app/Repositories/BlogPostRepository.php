<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

/**
 * @pacage App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(){
        return Model::class;
    }


    /**
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(){

        $fields = ['id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id'];

        $result = $this->startConditions()
        ->select($fields)
        ->orderBy('id', 'DESC')
        ->with([
            'category' => function ($query){
                $query->select(['id', 'title']);
            },
            'user:id,name',
        ])
        ->paginate(25);

        return $result;
    }


    /**
     * Get model for editing (for admin)
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

}
