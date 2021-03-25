<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $editableRole = null;
        $roleQuery = Role::query();
        $roleQuery->where('title', 'like', '%'.$request->get('q').'%');
        $roleQuery->orderBy('title');
        $roles = $roleQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableRole = Role::find(request('id'));
        }

        return view('roles.index', compact('roles', 'editableRole'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Role);

        $newRole = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newRole['creator_id'] = auth()->id();

        Role::create($newRole);

        return redirect()->route('roles.index');
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $roleData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $role->update($roleData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('roles.index', $routeParam);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Role $role)
    {
        $this->authorize('delete', $role);

        $request->validate(['role_id' => 'required']);

        if ($request->get('role_id') == $role->id && $role->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('roles.index', $routeParam);
        }

        return back();
    }
}
