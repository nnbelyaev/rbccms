<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission) {
        $this->permissions()->save($permission);
    }

    public function addPermissions($permissions) {
        if (!is_array($permissions)) return;

        $permission = new Permission();
        $readyForSync = $permission->makeActual($permissions);

        return $this->permissions()->sync($readyForSync);
    }
}
