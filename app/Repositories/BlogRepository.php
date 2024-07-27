<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

class BlogRepository
{


    /**
     * holds the specific model itself.
     *
     * @var Model
     */
    protected Model $model;

    /**
     * Create new Library class.
     *
     * this abstraction expects the child class to have a protected attribute named model.
     * that will hold the model name with its full namespace.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @return void
     */
    public function all()
    {
        $data = $this->model->get();
        return $data;
    }



    public function allWithCondition($key, $value, $operator  = "=")
    {
        $data = $this->model->where($key, $operator, $value)->paginate(10);
        return $data;
    }

    public function getWithCondition($key, $value, $operator  = "=")
    {
        $data = $this->model->where($key, $operator, $value)->get();
        return $data;
    }

    public function paginationWithCondition($key, $value, $operator  = "=")
    {
        $data = $this->model->where($key, $operator, $value)->paginate(10);
        return $data;
    }

    public function allWithConditionsRelation($conditions, $realtion)
    {
        $data = $this->model->with($realtion)->where($conditions)->paginate(10);
        return $data;
    }


    public function allWithOrder($key, $value)
    {
        $data = $this->model->orderBy($key, $value)->paginate(10);
        return $data;
    }


    /**
     * @return void
     */
    public function pagination($locale,$length = 10): LengthAwarePaginator
    {
        $data = $this->model->where(function ($query) use ($locale){
                $query->whereNull('locale')->orWhere('locale', $locale);
            })->latest()->paginate($length);
        return $data;
    }



    /**
     * getByID
     *
     * @param  mixed $model_id
     * @return object_model
     */
    function getByID($model_id)
    {
        $model = $this->model->find($model_id);
        return $model;
    }

    function getByIDRelation($model_id, $relation)
    {
        $model = $this->model->with($relation)->findOrFail($model_id);
        return $model;
    }

    /**
     * delete model by id
     *
     * @param [type] $model_id
     * @param boolean $force
     * @return void
     */
    public function deleteByID($model_id, bool $force = false): void
    {
        $model = $this->model->findOrFail($model_id);

        if ($force) {
            $model->forceDelete();
        }

        if (!$force) {
            $model->delete();
        }
    }


    /**
     * @return void
     */
    function save($data)
    {
        $model = $this->model->create($data);
        return $model->fresh();
    }


    public function searchManyByKey($key, $value)
    {
        $data = $this->model->where($key, 'like', '%' . $value . '%')->paginate(10);
        return $data;
    }

    public function first($data)
    {
        $data = $this->model->where($data)->first();
        return $data;
    }

    public function update($data, $id)
    {
        $model = $this->model->findOrFail($id);
        if ($model->image && array_key_exists('image', $data) && File::exists($model->image)) {
            unlink($model->image);
        }

        $model->update($data);
        return $model->fresh();
    }

    public function updateModel($data, $model)
    {

        $model->update($data);
        return $model->fresh();
    }

    public function attachModel($data, $model)
    {
        $model->attach($data);
    }

    public function syncModel($data, $model)
    {
        $model->sync($data);
    }

    public function getMNRelation($relation, $rId, $locale, $length = 10)
    {
        return $this->model->with($relation)
            ->whereHas($relation, function ($query) use ($rId) {
                $query->where('id', $rId);
            })->where(function ($query) use ($locale) {
            $query->where(function ($subQuery) use ($locale) {
                $subQuery->whereNull('locale'); // Get records with null locale
                $subQuery->orWhere('locale', $locale); // Get records with the specified value
            });
        })->orderBy('id', 'desc')->paginate($length);
    }

    public function getNullConditiontion( $value, $length = 10)
    {
        return $this->model->where(function ($query) use ($value) {
            $query->where(function ($subQuery) use ($value) {
                $subQuery->whereNull('locale'); // Get records with null locale
                $subQuery->orWhere('locale', $value); // Get records with the specified value
            });
        })->orderBy('id', 'desc')->paginate($length);
    }

    public function userBlogs($teams, $leagues, $locale='ar', $length = 10)
    {
        $query = $this->model->newQuery();

        // Filter by teams
        if (!empty($teams)) {
            $query->whereHas('teams', function ($query) use ($teams) {
                $query->whereIn('id', $teams);
            });
        }

        // Filter by leagues
        if (!empty($leagues)) {
            $query->whereHas('competitions', function ($query) use ($leagues) {
                $query->whereIn('id', $leagues);
            });
        }



        // Handle locale (optional)
        if ($locale) {
            $query->where(function ($query) use ($locale) {
            $query->where(function ($subQuery) use ($locale) {
                $subQuery->whereNull('locale'); // Get records with null locale
                $subQuery->orWhere('locale', $locale); // Get records with the specified value
            });
        });
        }

        // Order and paginate
        return $query->orderBy('id', 'desc')->paginate($length);
    }
}
