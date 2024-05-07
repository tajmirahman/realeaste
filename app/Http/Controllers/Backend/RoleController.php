<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    // All Permission
    public function AllPermission()
    {
        $permission = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permission'));
    }

    // Add Permission
    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    // Store Permission
    public function StorePermission(Request $request)
    {
        Permission::create([

            'name' => $request->name,
            'group_name' => $request->group_name,
            'created_at' => now(),
        ]);

        $notification = array(

            'message' => 'Permission Added Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.permission')->with($notification);
    }

    // Edit Permission
    public function EditPermission($id)
    {
        $permission = Permission::find($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    // Update Permission
    public function UpdatePermission(Request $request)
    {
        $uid = $request->id;

        Permission::findOrFail($uid)->update([

            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(

            'message' => 'Permission Update Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.permission')->with($notification);
    }

    // Delete Permission
    public function DeletePermission($id)
    {
        Permission::find($id)->delete();

        $notification = array(

            'message' => 'Permission Delete Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.permission')->with($notification);
    }

    //// Excel File \\\\\\\\\\\\\\\

    public function Emport()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    // Import
    public function Import()
    {
        return view('backend.pages.permission.import');
    }

    // StoreImport
    public function StoreImport(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(

            'message' => 'Permission File Upload Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.permission')->with($notification);
    }

    ///////////////////////////////// Role Section ///////////////

    // All Role
    public function AllRole()
    {
        $role = Role::all();
        return view('backend.pages.roles.all_role', compact('role'));
    }

    // Add Role
    public function AddRole()
    {
        return view('backend.pages.roles.add_role');
    }

    // Store Role
    public function StoreRole(Request $request)
    {
        Role::create([

            'name' => $request->name,
        ]);

        $notification = array(

            'message' => 'Role Added Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.role')->with($notification);
    }

    //Edit Role
    public function EditRole($id)
    {
        $role = Role::find($id);
        return view('backend.pages.roles.edit_role', compact('role'));
    }

    // Update Role
    public function UpdateRole(Request $request)
    {
        $uid = $request->id;

        Role::findOrFail($uid)->update([

            'name' => $request->name,
        ]);

        $notification = array(

            'message' => 'Role Update Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.role')->with($notification);
    }

    // Delete Role
    public function DeleteRole($id)
    {
        Role::find($id)->delete();

        $notification = array(

            'message' => 'Role Delete Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.role')->with($notification);
    }

    ///////////////// Role & Permission ////////////////////////////

    // All Roles Permission
    public function AllRolesPermission()
    {
        $role = Role::all();

        return view('backend.pages.rolesetup.all_roles_permission',compact('role'));
    }

    // Add Roles Permission
    public function AddRolesPermission()
    {
        $role = Role::all();
        $permissions = Permission::all();

        $permission_groups = User::getpermissionGroups();

        return view('backend.pages.rolesetup.add_roles_permission',compact('role','permissions','permission_groups'));
    }

    // Store Roles Permission
    public function StoreRolesPermission(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key=> $item)
        {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);

        }

        $notification = array(

            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('all.roles.permission')->with($notification);

    }

    // Admin Edit Roles
    public function AdminEditRoles($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        $permission_groups = User::getpermissionGroups();

        return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permissions','permission_groups'));
    }

    // Admin Update Roles
    public function AdminUpdateRoles(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions))
        {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    // Admin Delete Roles
    public function AdminDeleteRoles($id)
    {
        $role = Role::find($id);
        if(!is_null($role))
        {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }


}
