<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];
    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function makeActual($permissions)
    {
        $fsPermissions = app()->get('DataHelper')->getPermissions(false, true);
        $dbPermissions = $this->pluck('name')->all();

        $newPermissions = array_diff($fsPermissions, $dbPermissions);
        if (sizeof($newPermissions)) {
            foreach ($newPermissions as $newPermission) {
                $this->create(['name' => $newPermission]);
            }
        }

        $deletePermissions = array_diff($dbPermissions, $fsPermissions);
        if (sizeof($deletePermissions)) {
            foreach ($deletePermissions as $deletePermission) {
                $del = $this->where('name', $deletePermission);
                $del->delete();
            }
        }

        return $this->all()->whereIn('name', $permissions);
    }
}
