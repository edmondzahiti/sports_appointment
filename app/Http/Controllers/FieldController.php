<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Field\Field;
use App\Repositories\Admin\FieldRepository;
use DataTables;

class FieldController extends Controller
{

    protected $fieldRepository;

    /**
     * FieldController constructor.
     * @param FieldRepository $fieldRepository
     */
    public function __construct(FieldRepository $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.fields.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        $fields = $this->fieldRepository->get();

        return Datatables::of($fields)
            ->addColumn('name', function ($fields) {
                return $fields->name;
            })
            ->addColumn('capacity', function ($fields) {
                return $fields->capacity;
            })
            ->addColumn('created_at', function ($fields) {
                return $fields->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($field) {
                return view('admin.fields.includes.actions', compact('field'))->render();
            })
            ->rawColumns(['name', 'capacity', 'created_at', 'actions'])
            ->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * @param StoreFieldRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFieldRequest $request)
    {
        try {
            $this->fieldRepository->create($request->all());
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field created successfully!',
            ])
        ]);
    }

    /**
     * @param Field $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    /**
     * @param UpdateFieldRequest $request
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFieldRequest $request, $id)
    {
        try {
            $this->fieldRepository->update($request->all(), $id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field updated successfully!',
            ])
        ]);
    }

    /**
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->fieldRepository->delete($id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field deleted successfully!',
            ])
        ]);
    }
}
