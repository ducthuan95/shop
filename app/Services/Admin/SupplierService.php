<?php
/*
 * Created Date: 13/02/2023, 21:01
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Admin\SupplierRepository;

class SupplierService
{
    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {
        $wheres = [];

        return $this->supplierRepository->paginate($wheres);
    }

    public function store(array $params)
    {
        $params['status'] = 1;

        return $this->supplierRepository->store($params);
    }

    public function show(int $id)
    {
        return $this->getSupplierById($id);
    }

    public function update(int $id, array $params)
    {
        $supplier = $this->getSupplierById($id);

        return $this->supplierRepository->update($supplier, $params);
    }

    public function destroy(int $id)
    {
        $supplier = $this->getSupplierById($id);

        return $this->supplierRepository->delete($supplier);
    }

    private function getSupplierById(int $id)
    {
        $supplier = $this->supplierRepository->first($id, ['*'], []);

        if (! $supplier) {
            throw new NotFoundException();
        }

        return $supplier;
    }
}
