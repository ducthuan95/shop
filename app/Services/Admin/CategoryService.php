<?php
/*
 * Created Date: 14/02/2023, 14:58
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
use App\Repositories\Admin\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function paginate()
    {
        return $this->categoryRepository->paginate([]);
    }

    public function store(array $params)
    {
        return $this->categoryRepository->store($params);
    }

    public function show(int $id)
    {
        return $this->getCategoryById($id);
    }

    public function update(int $id, array $params)
    {
        $category = $this->getCategoryById($id);

        return $this->categoryRepository->update($category, $params);
    }

    public function destroy(int $id)
    {
        $category = $this->getCategoryById($id);

        return $this->categoryRepository->delete($category);
    }

    private function getCategoryById(int $id)
    {
        $category = $this->categoryRepository->first($id);

        if (! $category) {
            throw new NotFoundException();
        }

        return $category;
    }
}
