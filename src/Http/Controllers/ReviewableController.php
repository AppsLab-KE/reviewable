<?php

namespace Reviewable\Http\Controllers;


use Illuminate\Routing\Controller;

class ReviewableController extends Controller
{
    public function createReview()
    {
        return view('reviewable::reviewable.role-form-body')
            ->withPermissions(app(config('ruhusa.models.permission'))->all())
            ->withUsers(app(config('ruhusa.models.defaultUser'))->all());
    }


    public function createMonitor()
    {
        return view('reviewable::acl.permission-form-body');
    }


    public function editMonitor($permission)
    {
        return view('ruhusa::acl.permission-form-body')
            ->withRoles(app(config('ruhusa.models.role'))->all())
            ->withPermissions(app(config('ruhusa.models.permission'))->all())
            ->withPermission(app(config('ruhusa.models.permission'))->find($permission));
    }


    public function storeReview(Request $request)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        $this->roleValidation($request);
        $role = app(config('ruhusa.models.role'));

        $role = $role->create($request->all());

        $role->permissions()->syncWithoutDetaching($request->permissions);

        if ($request->has('users')){
            $role->users()->syncWithoutDetaching($request->users);
        }

        return redirect()->route('roles.index');
    }


    public function storeMonitor(Request $request)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        $this->permissionValidation($request);
        $permission = app(config('ruhusa.models.permission'));
        $permission = $permission->create($request->all());

        if ($request->has('roles')){
            $permission->roles()->syncWithoutDetaching($request->roles);
        }

        return redirect()->route('permissions.index');
    }

    public function updateMonitor(Request $request, $permission)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        $permission = app(config('ruhusa.models.permission'))->find($permission);

        if ($permission->slug != $request->slug){
            $this->permissionValidation($request);
        }

        $permission->update($request->all());

        $permission->roles()->detach();
        if ($request->has('roles')){
            $permission->roles()->sync($request->roles);
        }

        return redirect()->route('permissions.index');
    }

    public function editReview($role)
    {
        $roleModel = app(config('ruhusa.models.role'));
        $role =  $roleModel->findOrFail($role);

        return view('ruhusa::acl.role-form-body')
            ->withRole($role)
            ->withPermissions(app(config('ruhusa.models.permission'))->all())
            ->withUsers(app(config('ruhusa.models.defaultUser'))->all());
    }

    public function roleValidation(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', new SlugRule(app(config('ruhusa.models.role')))],
            'permissions' => ['required']
        ]);
    }

    public function reviews()
    {
        $roles = app(config('ruhusa.models.role'));
        if ($request->has('permission')){
            $permission = app(config('ruhusa.models.permission'))->find($request->permission);
            if ($permission) {
                $roles = $permission->roles();
            }
        }

        return view('ruhusa::acl.role')
            ->withRoles($roles->paginate(config('ruhusa.perPage')));
    }

    public function permissions(Request $request)
    {
        $permissions = app(config('ruhusa.models.permission'));
        if ($request->has('role')){
            $role = app(config('ruhusa.models.role'))->find($request->role);
            $permissions = [];
            if ($role) {
                $permissions = $role->permissions();
            }
        }

        return view('ruhusa::acl.permission')
            ->withPermissions($permissions->paginate(config('ruhusa.perPage')));
    }

    public function updateRole(Request $request, $role)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        $role = app(config('ruhusa.models.role'))->find($role);

        $request->validate([
            'permissions' => ['required']
        ]);

        if ($role->slug != $request->slug){
            $this->roleValidation($request);
        }

        $role->update($request->all());

        $role->permissions()->detach();
        $role->permissions()->sync($request->permissions);

        if ($request->has('users')){
            $role->users()->sync($request->users);
        }

        return redirect()->route('roles.index');
    }


    protected function permissionValidation(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', new SlugRule(app(config('ruhusa.models.permission')))],
        ]);
    }


    public function deleteRole($role)
    {
        $role = app(config('ruhusa.models.role'))->find($role);
        $role->users()->detach();
        $role->permissions()->detach();
        $role->delete();

        return back();
    }


    public function deletePermission($permission)
    {
        $permission = app(config('ruhusa.models.permission'))->find($permission);
        $permission->roles()->detach();
        $permission->users()->detach();
        $permission->delete();

        return back();
    }
}
