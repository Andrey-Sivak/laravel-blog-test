<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
    
    /**
     * Получить список статей для вывода в списке.
     * (Админка)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $fields = [
          'id',
          'title',
          'slug',
          'is_published',
          'published_at',
          'user_id',
          'category_id',
        ];
        
        $result = $this->startConditions()
            ->select($fields)
            ->orderBy('id', 'DESC')
            ->with([
                //можно так
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                //или так
                'user:id,name',
            ])
            ->paginate(25);
        
        return $result;
    }
    
}
