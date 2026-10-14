<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): view
    {
        $categories = Category::withCount('events')
           ->orderBy('name')
           ->get();

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    public function create(): view
    {
        return view('admin.categories.create');
    }

    public function store(
        CategoryRequest $request
    ): RedirectResponse {
        Category::create(
            $request->validated()
        );

        return redirect()
          ->route('admin.categories.index')
          ->with(
            'success',
            'Categoria criada com sucessso.'
          );
    }

    public function edit(Category $category): View
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update(
            $request->validated()
        );

        return redirect()
          ->route('admin.categories.index')
          ->with(
              'success',
              'Categoria atualizada com sucesso.'
          );
    }

    public function destroy(Category $category): RedirectResponse
    {
        if($category->events()->exists()) {
            return back()->with(
                'error',
                'Não é possível excluir uma categoria que possui eventos.'
            );
        }

        $category->delete();

        return redirect()
           ->route('admin.categories.index')
           ->with(
              'success',
              'Categoria excluída com sucesso.'
           );
    }
}
