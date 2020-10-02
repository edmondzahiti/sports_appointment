<?php

namespace App\Http\Controllers;

use App\Events\Auth\UserRegistered;
use App\Models\Field;
use App\Models\User\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fields.index');
    }

    public function datatable()
    {
        $fields = Field::get(['id', 'name', 'capacity', 'created_at']);

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'alpha', 'max:64'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);

        Field::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field created successfully!',
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $fields
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $fields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $request->validate([
            'name' => ['required', 'string', 'alpha', 'max:64'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);

        $field->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field updated successfully!',
            ])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $fields
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()->route('fields.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Field deleted successfully!',
            ])
        ]);
    }
}
