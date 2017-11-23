<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /** @var Model */
    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    /**
     * Create one record
     *
     * @param array $data
     * @return Model
     */
    public function createOne(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Insert one record
     *
     * @param array $data
     * @return bool
     */
    public function insertOne(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Insert multiple records
     *
     * @param array $data
     * EX: array(
     *         ['column_name' => 'Ricky', 'column_sex' => '0'],
     *         ['column_name' => 'Mary', 'column_sex' => '1']
     *     );
     *
     * @return bool
     */
    public function insertAll(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param null $with
     * @return Collection|static[]
     */
    public function all($with = null)
    {
        if (is_null($with)) {
            return $this->model->all();
        } else {
            return $this->model->with($with)->get();
        }
    }

    /**
     * @param $id
     * @param null $with (array | string)
     * @return Model
     */
    public function findOneById($id, $with = null)
    {
        if (is_null($with)) {
            return $this->model->find($id);
        } else {
            return $this->model->with($with)->find($id);
        }
    }

    /**
     * @param array $data
     * @param null $with
     * @return Model|null|static
     */
    public function findOneBy(array $data, $with = null)
    {
        if (is_null($with)) {
            return $this->model->where($data)->first();
        } else {
            return $this->model->with($with)->where($data)->first();
        }
    }

    /**
     * @param array $data
     * @param null $with
     * @return Collection|static[]
     */
    public function findAllBy(array $data , $with = null)
    {
        if (is_null($with)) {
            return $this->model->where($data)->get();
        } else {
            return $this->model->with($with)->where($data)->get();
        }
    }

    /**
     * @param array $data
     * @param array|null $data2
     * @return mixed
     */
    public function firstOrCreate(array $data, array $data2 = null)
    {
        if (is_null($data2)) {
            return $this->model->firstOrCreate($data);
        } else {
            return $this->model->firstOrCreate($data, $data2);
        }
    }

    /**
     * @param $where
     * @param $set
     * @return bool
     */
    public function update($where, $set)
    {
        return $this->model->where($where)->update($set);
    }

    /**
     * @param array $data
     * @param array|null $data2
     * @return Model
     */
    public function updateOrCreate(array $data, array $data2 = null)
    {
        if (is_null($data2)) {
            return $this->model->updateOrCreate($data);
        } else {
            return $this->model->updateOrCreate($data, $data2);
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function delete(array $data)
    {
        return $this->model->where($data)->delete();
    }

    /**
     * @param array $data
     * @return int
     */
    public function count(array $data)
    {
        return $this->model->where($data)->count();
    }
}