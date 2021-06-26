<?php


namespace App\Repositories\Base;


interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $data
     * @return mixed
     */
    public function save($data);

    /**
     * @param array $data
     * @param $model
     * @return mixed
     */
    public function update(array $data, $model);

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);
}
