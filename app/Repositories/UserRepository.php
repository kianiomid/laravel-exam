<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Base\RepositoryInterface;

class UserRepository implements RepositoryInterface
{

    /**
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        $user = new User();

        $user->setAttribute('name', filter_var($data['name'], FILTER_SANITIZE_STRING));
        $user->setAttribute('email', filter_var($data['email'], FILTER_VALIDATE_EMAIL));
        $user->setAttribute('password', bcrypt($data['password']));
        $user->save();

        return $user;
    }

    /**
     * @param array $data
     * @param $model
     * @return mixed
     */
    public function update(array $data, $model)
    {
        //
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        //
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        //
    }

    /**
     * @return mixed
     */
    public function getUserList()
    {
        return User::latest()->paginate(User::PAGINATION);
    }
}
