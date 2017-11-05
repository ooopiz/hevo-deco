<?php

namespace App\Repositories;

use phpDocumentor\Reflection\Types\Boolean;

abstract class AbstractRepository
{
    /**
     * Define Model
     */
    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    /**
     * Create one record (return model)
     *
     * @param array $data
     * @return mixed
     */
    public function createOne(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Insert one record
     *
     * @param array $data
     * @return bool (True | False)
     */
    public function insertOne(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Insert multiple records
     *
     * @param array $data
     * @return bool (True | False)
     */
    public function insertAll(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $id
     * @param null $with (array | string)
     * @return mixed
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
     * @param null $with (array | string)
     * @return mixed
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
     * @param null $with (array | string)
     * @return mixed
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
     * @return mixed
     */
    public function count(array $data)
    {
        return $this->model->where($data)->count();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isExists(array $data)
    {
        $count = $this->count($data);
        $boolean = $count > 0 ? true : false;
        return $boolean;
    }

    /**
     * @param array $data
     * @param array|null $data2
     * @return mixed (model)
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
     * @return Boolean
     */
    public function update($where, $set)
    {
        return $this->model->where($where)->update($set);
    }

    /**
     * @param array $data
     * @param array|null $data2
     * @return mixed (model)
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
     * @return mixed
     */
    public function delete(array $data)
    {
        return $this->model->where($data)->delete();
    }
}