<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $roles = Role::select('id', 'name')->where('name','!=','super admin')->get();
            return Datatables::of($roles)->addIndexColumn()
                ->addColumn('action', function ($roles) {
                    $button = '<a href="roles/' . $roles->id . '/addPermissionToRole" type="button" name="" id="' . $roles->id . '" class="assignRole btn btn-outline-success me-1"> <i class="fa-solid fa-elevator"></i> </a>';
                    $button .= '<button type="button" name="edit" id="' . $roles->id . '" roleName="' . $roles->name . '" class="edit btn btn-outline-secondary me-1"> <i class="fa-regular fa-pen-to-square "></i></button>';
                    // $button .= '<a href="roles/'.$roles->id.'/delete" type="button" name="" id="'.$roles->id.'" class="delete btn btn-danger btn-sm"> Delete</a>';
                    $button .= '<button type="button" name="delete" id="' . $roles->id . '" roleName="' . $roles->name . '" class="delete btn btn-outline-danger me-1"><i class="fa-solid fa-trash"></i></button>';

                    return $button;
                })
                ->make(true);
        }
        return view('admin.RolePermissions.role.indexTable');
    }
    public function create()
    {
        return view('admin.RolePermissions.role.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required']
        ]);
        Role::create(['name' => $request->name]);
        toast('successfully completed','success');
        return redirect('roles')->with('status', 'success');
    }

    public function edit(Role $role)
    {
        return view('admin.RolePermissions.role.edit', ['role' => $role]);
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->id);
        $request->validate([
            "name" => ['required|unique:roles,name,' . $role->id],
        ]);
        //    $role= Role::find($role->id);
        $role->update(['name' => $request->role]);
        toast('updated role successfully completed','success');
        return redirect('roles')->with('status', 'updated role successfully');
    }

    public function destoryRole(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();
        toast('deleted role successfully completed','success');
        return redirect('roles')->with('status', 'deleted role successfully');
    }
    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::find($roleId);
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_id', $roleId)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.RolePermissions.role.addPermission', compact('role', 'permissions', 'rolePermission'));
    }
    public function givePermissionsToRole($roleId, Request $request)
    {
        $role = Role::find($roleId);
        $role->syncPermissions($request->permission);
        // foreach($request->permission as $permission){
        //     // dd($permission);
        //     $role->syncPermissions($permission);
        //     // $permissionNames = $role->getPermissionNames();
        //     // dd($permissionNames->toArray());
        // }
        toast('assign permission to role successfully completed','success');
        return redirect()->back()->with(['status'=> 'assign permission to role successfully']);
    }

}
