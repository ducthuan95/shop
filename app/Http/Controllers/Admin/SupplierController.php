<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Supplier\SupplierListRequest;
use App\Http\Requests\Admin\Supplier\SupplierStoreRequest;
use App\Http\Requests\Admin\Supplier\SupplierUpdateRequest;
use App\Http\Resource\Admin\Supplier\SupplierCollection;
use App\Http\Resource\Admin\Supplier\SupplierResource;
use App\Services\Admin\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{

    private $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(SupplierListRequest $request)
    {
        return $this->getData(function () {
           return SupplierCollection::make($this->supplierService->index());
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SupplierStoreRequest $request)
    {
        $params = $request->dataValidated();

        return $this->getData(function () use ($params) {
            return $this->supplierService->store($params);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->getData(function () use ($id) {
           return SupplierResource::make($this->supplierService->show($id));
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SupplierUpdateRequest $request, $id)
    {
        $params = $request->dataValidated();

        return $this->getData(function () use ($id, $params) {
            return $this->supplierService->update($id, $params);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->getData(function () use ($id) {
           return $this->supplierService->destroy($id);
        });
    }
}
