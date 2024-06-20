<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryModel, $categoryService;
    function __construct(Category $categoryModel, CategoryService $categoryService)
    {
        $this->categoryModel = $categoryModel;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = $this->categoryModel->storeCategory($validated);

        if (!$category) {
            emotify('error', 'Failed to add category');
            return redirect()->route('categories.index');
        }

        emotify('success', 'Category added successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $updatedCategory = $this->categoryModel->updateCategory($validated, $category->id);

        if (!$updatedCategory) {
            emotify('error', 'Failed to update category');
            return redirect()->route('categories.index');
        }

        emotify('success', 'Category updated successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();

        if (!$deleted) {
            emotify('error', 'Failed to delete category');
            return redirect()->route('categories.index');
        }

        emotify('success', 'Category deleted successfully');
        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $categories = $this->categoryModel->searchCategory($request->search);
        $searchDisplay = $this->categoryService->searchResults($categories);

        return response($searchDisplay);
    }
}
