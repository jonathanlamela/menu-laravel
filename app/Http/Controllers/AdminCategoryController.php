<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminCategoryController extends Controller
{

    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true');
        $ascending = $ascending_value === 'true' ? 'asc' : 'desc';

        return Inertia::render("admin/category/AdminCategoryListPage", [
            "data" => Category::filter(request(['search']))->orderBy($orderBy, $ascending)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => $ascending_value === "true",
        ]);
    }

    public function create()
    {
        return Inertia::render("admin/category/AdminCategoryCreatePage");
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'name.unique' => "Il nome della categoria deve essere univoco"
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $category = Category::create($attributes);

        if ($request->file('imageFile')) {
            $uploadedFile = $request->file('imageFile');

            $file_path = Storage::putFileAs('media/category', $uploadedFile, $category->id . "." . $uploadedFile->extension());

            if ($file_path) {
                $category->update([
                    "image" => $file_path
                ]);
            }
        }

        session()->flash("success_message", "Categoria creata");

        return redirect(route('admin.category.list'));
    }

    public function edit(Category $category)
    {
        return Inertia::render("admin/category/AdminCategoryEditPage", [
            "category" => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $category->id,
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'name.unique' => "Il nome della categoria deve essere univoco"
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.edit', ["category" => $category->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        if ($request->file('imageFile')) {
            $uploadedFile = $request->file('imageFile');

            $file_path = Storage::putFileAs('media/category', $uploadedFile, $category->id . "." . $uploadedFile->extension());

            if ($file_path) {
                $attributes['image'] = $file_path;
            }
        }

        $category->update($attributes);


        session()->flash("success_message", "Categoria aggiornata");

        return redirect(route('admin.category.edit', ["category" => $category->id]));
    }

    public function delete(Category $category)
    {
        return Inertia::render("admin/category/AdminCategoryDeletePage", [
            "category" => $category
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $category = Category::find($id);

        if ($category->image) {
            Storage::delete("media/category", $category->image);
        }


        session()->flash("success_message", "Categoria " . $category->name . " eliminata");


        Category::destroy($id);
        return redirect(route('admin.category.list'));
    }
}
