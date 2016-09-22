<?php

namespace SedpMis\ModelCrud;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

abstract class BaseModelCrudController extends Controller
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

        return new Response($model, Response::HTTP_CREATED);
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

        return new Response('', Response::HTTP_NO_CONTENT);
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

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
