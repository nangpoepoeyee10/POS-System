<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    // createUserPage
    public function createUserPage()
    {
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'name')->all();
        $query = User::select('staff_id')->max('staff_id');
        if ($query) {
            $e = explode('-', $query);
            $staff_id = 'STAFF-'.str_pad($e[1] + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $staff_id = 'STAFF-001';
        }

        return view('admin.user.createuser', ['roles' => $roles, 'staff_id' => $staff_id]);
    }

    // createUser
    public function createUser(Request $request)
    {
        $this->validationCheck($request);

        $role = $request->role;
        $data = [
            'staff_id' => $request->staffId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'role' => $role,
            'gender' => $request->gender,
        ];

        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->image);
            $base64Image = base64_encode($imageData);

            // $image = uniqid().$request->file('image')->getClientOriginalName();
            // $request->file('image')->storeAs('public',$image);
            $data['image'] = $base64Image;
        }

        // dd($data);
        $user = User::create($data);

        $user->syncRoles($request->roles);

        return redirect()->route('admin#userLists');
    }

    // userLists
    public function userLists()
    {
        $query = User::select('staff_id')->max('staff_id');
        if ($query) {
            $e = explode('-', $query);
            $staff_id = 'STAFF-'.str_pad($e[1] + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $staff_id = 'STAFF-001';
        }

        $usersQuery = User::where('role', '!=', 'super admin')->when(request('query'), function ($result) {
            $result->where('name', 'like', '%'.request('query').'%');
        });
        $search = $usersQuery->first();

        if ($search == null) {
            $usersQuery = User::where('role', '!=', 'super admin');
        }
        $users = $usersQuery->paginate(3)->appends(request()->query());
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'name');

        return view('admin.user.userList', compact('users', 'roles', 'staff_id'));
    }

    // userLists with table

    public function userListsTable(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('staff_id', 'id', 'image', 'name', 'email', 'role', 'gender')->where('role', '!=', 'super admin')->get();

            return DataTables::of($users)->addIndexColumn()
                ->addColumn('action', function ($users) {
                    $button = '<button type="button" name="changeRoleTable" id="'.$users->id.'" roleName="'.$users->role.'" staffId="'.$users->staff_id.'" class="changeRoleTable btn btn-outline-success me-1"><i class="fa-solid fa-key"></i> </button>';
                    $button .= '<a href="'.route('admin#updatePage', $users->id).'" type="button" name="" id="'.$users->id.'" class="assignRole btn btn-outline-secondary me-1"> <i class="fa-regular fa-pen-to-square "></i></a>';
                    $button .= '<button type="button" name="" id="'.$users->id.'" userName="'.$users->name.'" class="deleteUser btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>';

                    // $button .= '<a href="roles/'.$users->id.'/delete" type="button" name="" id="'.$users->id.'" class="delete btn btn-danger btn-sm"> <i class="fa-solid fa-trash" style="color: white;"></i> </a>';
                    return $button;
                })
                ->make(true);
        }

        return view('admin#userLists');
    }

    // updatePage
    public function updatePage($userId)
    {
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'name')->all();
        $user = User::findOrFail($userId);
        $staff_id = $user->staff_id;
        $userRoles = $user->role;

        return view('admin.user.edit', compact('user', 'roles', 'userRoles', 'staff_id'));
    }

    // updateUser
    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $this->updateValidationCheck($request);
        $role = $request->roles[0];
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'gender' => $request->gender,
            // 'staff_id' => $request->staffId,
        ];

        // if($request->hasFile('image')){
        //     $dbData = User::where('id',$request->id)->first();
        //     $dbImage = $dbData->image;
        //     if($dbImage != null){
        //         Storage::delete('public/'.$dbImage);
        //     }
        //         $image = uniqid().$request->file('image')->getClientOriginalName();
        //         $request->file('image')->storeAs('public',$image);
        //         $data['image'] = $image;
        // }
        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->image);
            $base64Image = base64_encode($imageData);
            $data['image'] = $base64Image;
        }
        $user->update($data);
        $user->syncRoles($request->roles);
        toast('User account updated successfully completed.', 'success');

        return redirect()->route('admin#userLists')->with(['updateSuccess' => 'User Account updated successfully.']);
    }

    public function getRole($userId)
    {
        $roles = Role::pluck('name', 'name')->all();
        $user = User::findOrFail($userId);
        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view('admin.user.userList', compact('roles', 'userRoles'));
    }

    // deleteUser
    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)->delete();

        return redirect()->route('admin#userLists');
    }

    // changeRole
    public function changeRole(Request $request)
    {
        // dd($request->toArray());
        $role = $request->roles[0];
        $user = User::findOrFail($request->userId);
        // if(isset($request->staffId)){
        //     $data['staff_id'] = $request->staffId;
        // }else{
        //     $data['staff_id']= null;
        // }
        // User::where('id',$request->userId)->update(['role'=>$role,'staff_id' =>$request->staffId]);
        User::where('id', $request->userId)->update(['role' => $role]);
        $user->syncRoles($request->roles);

        return redirect()->route('admin#userLists');
    }

    // validationCheck
    private function validationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required |unique:users,email',
            'password' => 'required|min:8',
            'image' => 'mimes:png,jpg,jpeg,jfjf|file|max:8192',
            'confirmPassword' => 'required|same:password',
            'gender' => 'required',
            'staffId' => 'required|unique:users,staff_id',
            'role' => 'required|not_in:0',
        ])->validate();
    }

    // updateValidationCheck
    private function updateValidationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'unique:users,email,'.$request->id,
        ])->validate();
    }
}
