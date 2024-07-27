<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class UserRepository extends AbstractRepository
{

    /**
     * holds the specific model itself.
     *
     * @var Model
     */
    protected $model;

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
     * saveRestaurant function
     *
     * @param object $data
     * @return object
     */
    public function save($data)
    {

        $model = $this->model->create($data->all());


        return $model->fresh();
    }


    public function update($data, $user)
    {

        $user->update($data->except(['country_id','university_id','college_id','major_id']));


        return $user->fresh();
    }
      public function updateStatus($user)
    {
        $user->update(['invitation_code_status'=>1]);
        return $user->fresh();
    }
    /**
     * asignRoleToUser function
     *
     * @return Collection
     */
    public function asignRoleToUser($id, $roles)
    {
        try {

            $user = $this->model->where('id', $id)->firstOrFail();
            $user->syncRoles($roles);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function insertImage($file, $user)
    {
        $user->image = $file;
        return $user->save();
    }

    public function getUser($conditions = [])
    {
        $user = $this->model->where($conditions)->first();
        return $user;
    }

    public function firstOrCreate($data)
    {
        $name = explode('@',$data->email)[0];
        $user = $this->model->firstOrCreate([
            'email' => $data->email
        ], [
            'name' => $data->name,
            'email' => $data->email,
            'image' => $data->image,
            'locale' => $data->locale??"en",
            'code' => rand(100000000000, 9999999999999),
        ]);
        return $user->fresh();
    }

    public function findUser($conditions)
    {
        $user = $this->model->where($conditions)->first();
        return $user;
    }

    public function findNonAuthUser($user)
    {
        $user = $user->where('id', '!=', auth()->user()->id)->first();
        return $user;
    }
    public function updatePoints($user, $points)
    {
        $user->points += $points;
        $user->save();
    }
    public function getFcm($blogTeamIds, $blogCompetitionIds)
    {
        return $userQuery = $this->model->with('favorites')
            ->whereHas('favorites', function ($query) use ($blogTeamIds, $blogCompetitionIds) {
                $query->whereIn('type', [1, 2])
                    ->where(function ($query) use ($blogTeamIds, $blogCompetitionIds) {
                        $query->whereIn('favoritable_id', $blogTeamIds)
                            ->where('type', 1);
                        $query->orWhereIn('favoritable_id', $blogCompetitionIds)
                            ->where('type', 2);
                    });
            })
            ->distinct()
            ->pluck('device_token')->toArray();
    }
    public function getLocaleFcm($locale, $blogTeamIds, $blogCompetitionIds)
    {
        return $userQuery = $this->model->where('locale',$locale)->with('favorites')
            ->whereHas('favorites', function ($query) use ($blogTeamIds, $blogCompetitionIds) {
                $query->whereIn('type', [1, 2])
                    ->where(function ($query) use ($blogTeamIds, $blogCompetitionIds) {
                        $query->whereIn('favoritable_id', $blogTeamIds)
                            ->where('type', 1);
                        $query->orWhereIn('favoritable_id', $blogCompetitionIds)
                            ->where('type', 2);
                    });
            })
            ->distinct()
            ->pluck('device_token')->toArray();
    }
    public function getAllFcm(){
        return $this->model->whereNotNull('device_token')->pluck('device_token')->toArray();
    }

    public function getAllLocaleFcm($locale){
        return $this->model->where('locale',$locale)->whereNotNull('device_token')->pluck('device_token')->toArray();
    }
}
