<?php

namespace App\Repositories\Admin;

use App\Exceptions\GeneralException;
use App\Models\Field\Field;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProfileRepository.
 */
class ProfileRepository extends BaseRepository
{


    /**
     * ProfileRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $user = $this->find($id);

            $updatedUser = $this->updateProfile($user, $data);

            if ($updatedUser) {
                return $updatedUser;
            }

            throw new GeneralException(__('There was a problem updating user.'));
        });
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws GeneralException
     */
    public function updateProfile(User $user, array $data) : User
    {
        $this->checkUserByEmail($user, $data['email']);

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
            ])) {
                return $user;
            }

            throw new GeneralException('error');
        });
    }

    /**
     * @param User $user
     * @param $email
     * @throws GeneralException
     */
    protected function checkUserByEmail(User $user, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($user->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException('error');
        }
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws GeneralException
     */
    public function checkPassword(User $user, array $data) : User
    {
        if ($user->update(['password' => Hash::make($data['password'])])) {

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param int $id
     * @return Field
     */
    public function find(int $id) : User
    {
        return $this->model->find($id);
    }
}

