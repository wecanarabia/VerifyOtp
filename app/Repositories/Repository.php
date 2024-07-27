<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

class Repository
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



    public function all()
    {
        $data = $this->model->orderByDesc('created_at')->get();
        return $data;
    }

    public function pluck($col)
    {
        $data = $this->model->pluck($col)->toArray();
        return $data;
    }

    public function getCondition($condition)
    {
        $data = $this->model->where($condition)->get();
        return $data;
    }

    public function getNullConditiontion($key,$val)
    {
        $data = $this->model->where($key,$val)->orWhereNull($key)->orderByDesc('created_at')->get();
        return $data;
    }

    public function getNullConditiontionPagination($key,$val)
    {
        $data = $this->model->where($key,$val)->orWhereNull($key)->orderByDesc('created_at')->paginate(10);
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
    public function pagination($length = 10): LengthAwarePaginator
    {
        $data = $this->model->orderByDesc('created_at')->paginate($length);
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

    function getByIDRelationPagination($model_id,$relation,$length=10)
    {
        $model = $this->model->with([$relation=>function ($q)use($length){
            $q->paginate($length);
        }])->findOrFail($model_id);
        return $model;
    }

    function getByIDRelation($model_id,$relation)
    {
        $model = $this->model->with([$relation=>function ($q){
            $q->orderByDesc('created_at');
        }])->findOrFail($model_id);
        return $model;
    }
    function getByIDRelationPage($model_id,$relation,$length)
    {
        $model = $this->model->with([$relation=>function ($q)use($length){
            $q->orderByDesc('created_at')->paginate($length);
        }])->findOrFail($model_id);
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
    public function exists($data)
    {
        $data = $this->model->where($data)->exists();
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

    public function getMNRelation($relation,$rId,$length = 10) {
        return $this->model->with($relation)
                      ->whereHas($relation, function ($query) use ($rId) {
                          $query->where('id', $rId);
                      })
                      ->paginate($length);
    }

    public function firstOrCreate($findData,$data=[])
    {
     $model = $this->model->firstOrCreate(
                    $findData,$data);
        return $model->fresh();
    }
    public function updateOrCreate($findData,$data=[])
    {
     $model = $this->model->updateOrCreate(
                    $findData,$data);
        return $model->fresh();
    }
}
