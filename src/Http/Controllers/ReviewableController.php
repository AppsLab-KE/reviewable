<?php

namespace Reviewable\Http\Controllers;


use Illuminate\Routing\Controller;
use Reviewable\Http\Rules\MonitorRule;
use Reviewable\Models\Review;

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


    public function storeReview()
    {
        request()->request->add(['slug' => str_slug(request()->name)]);
        $this->roleValidation(request());
        $role = app(config('ruhusa.models.role'));

        $role = $role->create(request()->all());

        $role->permissions()->syncWithoutDetaching(request()->permissions);

        if (request()->has('users')){
            $role->users()->syncWithoutDetaching(request()->users);
        }

        return redirect()->route('roles.index');
    }


    public function storeMonitor()
    {
        request()->request->add(['slug' => str_slug(request()->name)]);
        $this->permissionValidation(request());
        $permission = app(config('ruhusa.models.permission'));
        $permission = $permission->create(request()->all());

        if (request()->has('roles')){
            $permission->roles()->syncWithoutDetaching(request()->roles);
        }

        return redirect()->route('permissions.index');
    }

    public function updateMonitor($permission)
    {
        request()->request->add(['slug' => str_slug(request()->name)]);
        $permission = app(config('ruhusa.models.permission'))->find($permission);

        if ($permission->slug != request()->slug){
            $this->permissionValidation(request());
        }

        $permission->update(request()->all());

        $permission->roles()->detach();
        if (request()->has('roles')){
            $permission->roles()->sync(request()->roles);
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

    public function roleValidation()
    {
        request()->validate([
            'name' => ['required', 'string', new SlugRule(app(config('ruhusa.models.role')))],
            'permissions' => ['required']
        ]);
    }

    public function reviews()
    {
        $reviews = app(config('reviewable.models.review'));

        $review = new Review();
        $user = app('App\User')->find(1);
        $hotel = app('App\Models\Hotel')->create([
            'name' => 'demo guy',
            'slogan' => 'this is it',
            'email' => 'marv@d'.time().'d.com',
            'phone_no' => '0704407117',
            'street' => 'langata',
            'photo' => '/dejje',
            'slug' => 'dmeo-dmeo',
            'user_id' => $user->id,
            'activated' => true
        ]);
        dd($hotel);

        dd($review->fill(array_merge([
            'title' => 'demo',
            'review' => 'demo review',
            'approved' => 1,
            'hotel_id' => 1,
            'rating' => 7,
        ],[
            'reviewer_id' => $user->id,
            'reviewer_type' => get_class($user)
        ])));
        dd($user->reviews()->save(app(config('reviewable.models.review'))->create()));

        dd(app(config('reviewable.models.review'))->create([
            'title' => 'demo',
            'review' => 'demo review',
            'approved' => 1,
            'hotel_id' => 1,
            'rating' => 7,
        ]));

        return view('reviewable::reviews.review')
            ->withReviews($reviews->paginate(config('reviewable.perPage')));
    }

    public function permissions()
    {
        $permissions = app(config('ruhusa.models.permission'));
        if (request()->has('role')){
            $role = app(config('ruhusa.models.role'))->find(request()->role);
            $permissions = [];
            if ($role) {
                $permissions = $role->permissions();
            }
        }

        return view('ruhusa::acl.permission')
            ->withPermissions($permissions->paginate(config('ruhusa.perPage')));
    }

    public function updateRole($role)
    {
        request()->request->add(['slug' => str_slug(request()->name)]);
        $role = app(config('ruhusa.models.role'))->find($role);

        request()->validate([
            'permissions' => ['required']
        ]);

        if ($role->slug != request()->slug){
            $this->roleValidation(request());
        }

        $role->update(request()->all());

        $role->permissions()->detach();
        $role->permissions()->sync(request()->permissions);

        if (request()->has('users')){
            $role->users()->sync(request()->users);
        }

        return redirect()->route('roles.index');
    }


    protected function permissionValidation()
    {
        request()->validate([
            'name' => ['required', 'string', new MonitorRule(app(config('ruhusa.models.permission')))],
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
