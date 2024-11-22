<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $permissions= Permission::select('id','name')->get();
                return Datatables::of($permissions)->addIndexColumn()
                    ->addColumn('action', function($permissions){
                        $button = '<button type="button" name="edit" id="'.$permissions->id.'" permissionName="'.$permissions->name.'" class="edit btn btn-outline-secondary me-1"><i class="fa-regular fa-pen-to-square "></i></button>';
                       // $button .= '<a href="permissions/'.$permissions->id.'/delete" type="button" name="" id="'.$permissions->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        $button .= '<button type="button" name="delete" id="'.$permissions->id.'" permissionName="'.$permissions->name.'" class="delete btn btn-outline-danger me-1"><i class="fa-solid fa-trash"></i></button>';

                        return $button;
                    })
                    ->make(true);
                }
                // $inventories = Inventory::select('product_id','stock_balance')->where('stock_balance','<','10')->get()->toArray();

        return view('admin.RolePermissions.permissions.index');
    }

    public function create(){
        return view('admin.RolePermissions.permissions.create');
    }

    public function store(Request $request){
        $request->validate([
            "name" =>['required']
        ]);
        Permission::create(['name' => $request->name]);
        toast('created role successfully completed','success');
        return redirect('permissions')->with('status','created role successful');
    }

    public function edit(Permission $permission){
         //return $permission;
        //  $inventories = Inventory::select('product_id','stock_balance')->where('stock_balance','<','10')->get()->toArray();

        return view('admin.RolePermissions.permissions.edit',[
            'permission'=>$permission,
        ]);
    }

    public function updatePermission(Request $request){

        $permission =  Permission::find($request->id);;
        $request->validate([
            'name' =>['required|unique:permissions,'.$permission->id]
        ]);
        Permission::where('id',$permission->id)->update(['name'=>$request->permission]);
        toast('updated permission successfully completed','success');

        return redirect('permissions')->with('status','updated permission successful');

    }
    public function destoryPermission(Request $request){
        $permission = Permission::find($request->id);
        $permission->delete();
        toast('deleted permission successfully completed','success');

        return redirect('permissions')->with('status','deleted permission successfully');
    }


}
