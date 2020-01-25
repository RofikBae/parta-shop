<?php

namespace App\Permissions;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Support\Arr;

trait HasPermissionsTrait
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }

        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasPermission($permission)
    {

        return $this->permissions()->where('name', $permission->name)->count();
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function givePermission($permission)
    {
        $permissions = $this->getAllPermission($permission);

        if ($permissions === null) {
            return $this;
        }

        return $this->permissions()->saveMany($permissions);
    }

    public function revokePermission($permission)
    {
        $permissions = $this->getAllPermission($permission);

        if ($permissions === null) {
            return $this;
        }

        return $this->permissions()->detach($permissions);
    }

    public function updatePermission($permission)
    {
        $this->revokePermission($permission);
        return $this->givePermission($permission);
    }

    protected function getAllPermission($permission)
    {
        return Permission::whereIn('name', $permission)->get();
    }

    public function assignRole($role)
    {
        $roles = $this->getAllRole($role);

        if ($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);

        return $this;
    }

    public function removeRole($role)
    {
        $roles = $this->getAllRole($role);

        if ($roles === null) {
            return $this;
        }
        $this->roles()->detach($roles);

        return $this;
    }

    public function syncRole($role)
    {
        $this->removeRole($role);
        $this->assignRole($role);

        return $this;
    }

    protected function getAllRole($role)
    {
        return Role::whereIn('name', $role)->get();
    }
}
