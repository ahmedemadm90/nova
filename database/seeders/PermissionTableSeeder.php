<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Roles', 'Roles List', 'Role Create', 'Role Edit', 'Role Delete', 'Role show',
            'Users', 'Users List', 'User Create', 'User Edit', 'User Delete', 'User Show',
            'Workers', 'Workers List', 'Worker Create', 'Worker Edit', 'Worker Delete', 'Worker Show',
            'Violations', 'Violations List', 'Violation Create', 'Violation Edit',
            'Violation Delete', 'Violation Show', 'My Area Violations',
            'VPS', 'VPs List', 'VP Create', 'VP Edit', 'VP Delete', 'VP Show',
            'Areas', 'Areas List', 'Area Create', 'Area Edit', 'Area Delete', 'Area Show',
            'Titles', 'Titles List', 'Title Create', 'Title Edit', 'Title Delete', 'Title Show',
            'Types', 'Types List', 'Type Create', 'Type Edit', 'Type Delete', 'Type Show',
            'Permits', 'Permits List', 'Permit Create', 'Permit Edit', 'Permit Delete', 'Permit Show', 'Permit Approve', 'Permit Reject',
            'Request Truck Permit', 'Request Private Permit', 'View Permits State', 'Manage Private Permits',
            'Manage vehicles Permits', 'Refused Permits List', 'Approved Permits List', 'Expired Permits List',
            'Manage Own Permits', 'Approve Own Permit', 'Reject Own Permit', 'Approve Group Permits', 'Reject Group Permits',
            'Groups', 'Groups List', 'Group Create', 'Group Edit', 'Group Delete', 'Group Show',
            'Reports', 'Print Report', 'Export Report as CSV', 'Export Report as Excel', 'Export Report as PDF',
            'Drivers', 'Drivers List', 'Driver Create', 'Driver Edit', 'Driver Show', 'Driver Delete',
            'Companies', 'Companies List', 'Company Create', 'Company Edit', 'Company Show', 'Company Delete',
            'Service Companies', 'Service Companies List', 'Service Company Create', 'Service Company Edit', 'Service Company Show', 'Service Company Delete',
            'Safety', 'Safety Comment', 'Area Comment',
            'Unfixed Permits', 'Unfixed Permits List', 'Unfixed Permit Create', 'Unfixed Permit Edit', 'Unfixed Permit Show',
            'Unfixed Permit Delete',
            'Unfixed Service Emps', 'Unfixed Service Emp Create', 'Unfixed Service Emp Edit',
            'Unfixed Service Emp Delete', 'Unfixed Service Emp Show',
            'Uae Violations', 'Uae Violations List', 'Uae Violation Create', 'Uae Violation Edit', 'Uae Violation Delete', 'Uae Violation Show,',
            'Countries', 'Countries List', 'Country Create', 'Country Edit', 'Country Delete', 'Country Show',
            'Locations', 'Locations List', 'Location Create', 'Location Edit', 'Location Delete', 'Location Show',
            'Classifications', 'Classifications List', 'Classification Create', 'Classification Edit', 'Classification Delete', 'Classification Show',
            'DVRS', 'DVRS List', 'DVR Create', 'DVR Edit', 'DVR Delete', 'DVR Show', 'DVR U/P',
            'Cameras', 'Cameras List', 'Camera Create', 'Camera Edit', 'Camera Delete', 'Camera Show',
            'Switches', 'Switches List', 'Switch Create', 'Switch Edit', 'Switch Delete', 'Switch Show',
            'View Switch U/P',
            'Vlans', 'Vlan Create', 'Vlan Edit', 'Vlan Delete', 'Vlan Show',
            'Tickets List', 'Ticket Create', 'Ticket Edit', 'Ticket Delete', 'Ticket Show', 'Ticket Close', 'Ticket Tech Comment',
            'Haulers', 'Haulers List', 'Hauler Create', 'Hauler Edit', 'Hauler Delete', 'Hauler Show',
            'Trucks', 'Trucks List', 'Truck Create', 'Truck Edit', 'Truck Delete', 'Truck Show',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
