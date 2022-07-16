<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{

    public function list()
    {
        return view('admin.category.list', [
            "items" => Category::filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
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

        if ($request->file('immagine')) {
            $uploadedFile = $request->file('immagine');

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
        return view('admin/category/edit', [
            "item" => $category
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

        if ($request->file('immagine')) {
            $uploadedFile = $request->file('immagine');

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
        return view('admin.category.delete', [
            "item" => $category
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'name.unique' => "Il nome della categoria deve essere univoco"
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $category = Category::find($id);

        Storage::delete("media/category", $category->image);

        session()->flash("success_message", "Categoria " . $category->name . " eliminata");


        Category::destroy($id);
        return redirect(route('admin.category.list'));
    }
}
