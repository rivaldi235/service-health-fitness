<?php

namespace App\Service;

use App\Repositories\CategoryJurnalFoodRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Class CategoryJurnalFoodService
{
    protected $categoryRepository;

    public function __construct(CategoryJurnalFoodRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories()
    {
        $categories = $this->categoryRepository->getCategories();
        return $categories;
    }

    public function createCategory(array $data)
    {
        $category = $this->categoryRepository->createCategory($data);
        return $category;
    }

    public function getCategory(string $id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        return $category;
    }

    public function updateCategory(string $id, array $data)
    {
        $category = $this->getCategory($id);
        $category = $this->categoryRepository->updateCategory($category, $data);
        return $category;
    }

    public function deleteCategory(string $id)
    {
        $category = $this->getCategory($id);
        $this->categoryRepository->deleteCategory($category);
    }
}