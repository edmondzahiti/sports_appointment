<?php

namespace App\Repositories\Admin;

use App\Exceptions\GeneralException;
use App\Models\Field\Field;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class FieldRepository.
 */
class FieldRepository extends BaseRepository
{

    /**
     * FieldRepository constructor.
     * @param Field $model
     */
    public function __construct(Field $model)
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

            $field = $this->createField($data);

            if ($field) {
                return $field;
            }

            throw new GeneralException(__('There was a problem creating field.'));
        });
    }


    /**
     * @param array $data
     * @return Field
     */
    protected function createField(array $data = []): Field
    {
        return $this->model::create($data);
    }


    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {

            $field = $this->updateField($data, $id);

            if ($field) {
                return $field;
            }

            throw new GeneralException(__('There was a problem updating field.'));
        });
    }


    /**
     * @param array $data
     * @param int $id
     * @return Field
     */
    public function updateField(array $data, int $id) : Field
    {
        $field = $this->find($id);

        $field->update($data);

        return $field->refresh();
    }


    /**
     * @param int $id
     * @return Field
     */
    public function find(int $id) : Field
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

