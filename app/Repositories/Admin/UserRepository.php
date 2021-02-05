<?php

namespace App\Repositories\Admin;

use App\Events\Auth\UserRegistered;
use App\Exceptions\GeneralException;
use App\Models\Field\Field;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{

    /**
     * FieldRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $user = $this->createUser($data);

            if ($user) {

                event(new UserRegistered($user));

                return $user;
            }

            throw new GeneralException(__('There was a problem creating user.'));
        });
    }


    /**
     * @param array $data
     * @return Field
     */
    protected function createUser(array $data = []): User
    {
        $user = $this->model::create($data);

        $user->update([
            'password' => Hash::make($user->name.$user->created_at->format('h:s').$user->surname.$user->created_at->format('i')),
            'email_verified_at' => now(),
        ]);

        return $user;
    }


    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {

            $user = $this->updateUser($data, $id);

            if ($user) {
                return $user;
            }

            throw new GeneralException(__('There was a problem updating field.'));
        });
    }


    /**
     * @param array $data
     * @param int $id
     * @return User
     */
    public function updateUser(array $data, int $id) : User
    {
        $user = $this->find($id);

        if ($user->email != $data['email'])
        {
            $user->update([
                'password' => Hash::make($user->name.$user->created_at->format('h:s').$user->surname.$user->created_at->format('i')),
                'email' => $data['email'],
            ]);
            event(new UserRegistered($user));
        }

        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'is_admin' => $data['role'],
        ]);

        return $user->refresh();
    }


    /**
     * @param int $id
     * @return User
     */
    public function find(int $id) : User
    {
        return $this->model->find($id);
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        return $this->model->where('id', $id)->delete();
    }
}

