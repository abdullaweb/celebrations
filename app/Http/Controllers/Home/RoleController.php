<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    // ============= Start permission all method ==========////
    public function AllPermission()
    {
        $allPermissions = Permission::latest()->get();
        return view('admin.permission.all_permission', compact('allPermissions'));
    }

    public function AddPermission()
    {
        return view('admin.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Paid Amount added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id)
    {
        $permissionInfo = Permission::findOrFail($id);
        return view('admin.permission.edit_permission', compact('permissionInfo'));
    }


    public function UpdatePermission(Request $request)
    {
        $permissionId = $request->id;

        Permission::findOrFail($permissionId)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    // ============= End permission all method ==========////





    // ============= Start role all method ==========////

    public function AllRole()
    {
        $allRole = Role::all();
        return view('admin.role.all_role', compact('allRole'));
    }

    public function AddRole()
    {
        return view('admin.role.add_role');
    }

    public function StoreRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id)
    {
        $roleInfo = Role::findOrFail($id);
        return view('admin.role.edit_role', compact('roleInfo'));
    }


    public function UpdateRole(Request $request)
    {
        $roleId = $request->id;

        Role::findOrFail($roleId)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRole($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    }

    // ============= End permission all method ==========////


    // ============= Add Role In Permission all method ==========////
    public function AddRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissiongroups();
        return view('admin.role.add_role_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function AllRolePermission()
    {
        $allRole = Role::all();
        return view('admin.role.all_role_permission', compact('allRole'));
    }


    public function StoreRolepermission(Request $request)
    {
        $data = array();
        $permissions = $request->permission;
        foreach ($permissions as $key => $permission) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $permission;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);
    }

    public function AdminEditRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissiongroups();
        return view('admin.role.edit_role_permission', compact('role', 'permissions', 'permission_groups'));
    }

    public function AdminUpdateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);
    } //end method

    public function AdminDeleteRole($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = array(
            'message' => 'Role Permission Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
