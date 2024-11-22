<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //categorylist with datatables
    public function categoryIndex(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id . '" categoryName="' . $row->name . '" class="edit btn btn-outline-secondary me-1"> <i class="fa-regular fa-pen-to-square "></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-outline-danger"> <i class="fa-solid fa-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.search');
    }
    // public function createCategoryPage()
    // {

    //     return view('admin.category.createCategory');
    // }
    //create Category
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        $validationRules = [
            'name' => 'required|unique:categories',
        ];
        Validator::make($request->all(), $validationRules)->validate();
        Category::create($data);
        return redirect()->route('category.index');
    }

    //update category
    public function updateCategory(Request $request)
    {
        $this->updateValidationCheck($request);
        $data = [
            'name' => $request->name,
        ];
        Category::where('id', $request->id)->update($data);
        return redirect()->route('category.index');
    }

    //delete category
    public function deleteCategory(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return redirect()->route('category.index');
    }
    private function updateValidationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $request->id,
        ]);
    }
}
