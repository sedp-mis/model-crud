<?php

namespace SedpMis\ModelCrud;

abstract class BaseModelCrudController extends \ApiController
{
    protected $model;

    /**
     * Display a listing of the resource.
     * GET /<resource>.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     * GET /<resource>/{id}.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     * POST /<resource>.
     *
     * @return Response
     */
    public function store()
    {
        validate($data = Input::except('_token'), $this->model->rules());

        $model = $this->model->create($data);

        return $this->respondCreated($model);
    }

    /**
     * Update the specified resource in storage.
     * PUT /<resource>/{id}.
     *
     * @param  int      $id
     * @return Response
     */
    public function update($id)
    {
        $model = $this->model->findOrFail($id);

        $data = Input::except('_token');

        validate($data, $this->model->rules(array_keys($data)));

        $model->fill($data);
        $model->save();

        return $this->respondNoContent();
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /<resource>/{id}.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return $this->respondNoContent();
    }
}
