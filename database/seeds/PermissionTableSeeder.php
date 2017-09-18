<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
        	[
        		'name' => 'role-list',
        		'display_name' => 'Xem danh sách quyền',
        		'description' => 'Xem danh sách quyền'
        	],
        	[
        		'name' => 'role-create',
        		'display_name' => 'Thêm mới quyền',
        		'description' => 'Thêm mới quyền'
        	],
        	[
        		'name' => 'role-edit',
        		'display_name' => 'Sửa quyền',
        		'description' => 'Sửa quyền'
        	],
        	[
        		'name' => 'role-delete',
        		'display_name' => 'Xóa quyền',
        		'description' => 'Xóa quyền'
        	],
        	[
        		'name' => 'video-list',
        		'display_name' => 'Xem danh sách video',
        		'description' => 'Xem danh sách video'
        	],
        	[
        		'name' => 'video-create',
        		'display_name' => 'Thêm mới video',
        		'description' => 'Thêm mới video'
        	],
        	[
        		'name' => 'video-edit',
        		'display_name' => 'Sửa video',
        		'description' => 'Sửa video'
        	],
        	[
        		'name' => 'video-delete',
        		'display_name' => 'Xóa video',
        		'description' => 'Xóa video'
        	]
        ];

        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
