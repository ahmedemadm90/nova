<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VpController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DVRController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HaulerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SafetyController;
use App\Http\Controllers\ServiceCompanyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\UaeViolationController;
use App\Http\Controllers\UnfixedPermitController;
use App\Http\Controllers\UnfixedServiceController;
use App\Http\Controllers\ViolationTypeController;
use App\Http\Controllers\VlanController;
use App\Models\ViolationType;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Auth::routes();
/* Ahmed Abdel-Wahab Dashboard */
Route::get('/testDashboard', [HomeController::class, 'testDashboard'])->name('test.dashboard');
Route::any('/replytestDashboard', [HomeController::class, 'replytestDashboard'])->name('reply.dashboard');
/* Ahmed Abdel-Wahab Dashboard */
Route::any('/logout', [UserController::class, 'logout'])->name('logout');
Route::any('/findvpareas', [ViolationController::class, "selectArea"])->name('findvpareas');
Route::post('/Dashbord/date', [HomeController::class, "dashboardByDate"])->name('dashboardByDate');
Route::any('/findlocations', [CountryController::class, "selectLocation"])->name('findlocations');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::prefix('users')->group(function () {
        Route::get('/index', [UserController::class, "index"])->name('users.index');
        Route::get('/create', [UserController::class, "create"])->name('user.create');
        Route::get('/show/{id}', [UserController::class, "show"])->name('user.show');
        Route::post('/store', [UserController::class, "store"])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, "edit"])->name('user.edit');
        Route::any('/update/{id}', [UserController::class, "update"])->name('user.update');
        Route::any('/delete/{id}', [UserController::class, "destroy"])->name('user.destroy');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/index', [RoleController::class, "index"])->name('roles.index');
        Route::get('/create', [RoleController::class, "create"])->name('role.create');
        Route::get('/show/{id}', [RoleController::class, "show"])->name('role.show');
        Route::post('/store', [RoleController::class, "store"])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, "edit"])->name('role.edit');
        Route::any('/update/{id}', [RoleController::class, "update"])->name('role.update');
        Route::any('/delete/{id}', [RoleController::class, "destroy"])->name('role.destroy');
    });
    Route::prefix('classification')->group(function () {
        Route::get('/index', [ViolationTypeController::class, "index"])->name('classifications.index');
        Route::get('/create', [ViolationTypeController::class, "create"])->name('classification.create');
        Route::get('/show/{id}', [ViolationTypeController::class, "show"])->name('classification.show');
        Route::post('/store', [ViolationTypeController::class, "store"])->name('classification.store');
        Route::get('/edit/{id}', [ViolationTypeController::class, "edit"])->name('classification.edit');
        Route::any('/update/{id}', [ViolationTypeController::class, "update"])->name('classification.update');
        Route::any('/delete/{id}', [ViolationTypeController::class, "destroy"])->name('classification.destroy');
    });
    Route::prefix('cameras')->group(function () {
        Route::get('/index', [CameraController::class, "index"])->name('cameras.index');
        Route::get('/create', [CameraController::class, "create"])->name('camera.create');
        Route::get('/show/{id}', [CameraController::class, "show"])->name('camera.show');
        Route::post('/store', [CameraController::class, "store"])->name('camera.store');
        Route::get('/edit/{id}', [CameraController::class, "edit"])->name('camera.edit');
        Route::any('/update/{id}', [CameraController::class, "update"])->name('camera.update');
        Route::any('/delete/{id}', [CameraController::class, "destroy"])->name('camera.destroy');
        Route::any('/findcams', [CameraController::class, "find"])->name('findcams');
    });
    Route::prefix('dvrs')->group(function () {
        Route::get('/index', [DVRController::class, "index"])->name('dvrs.index');
        Route::get('/create', [DVRController::class, "create"])->name('dvr.create');
        Route::get('/show/{id}', [DVRController::class, "show"])->name('dvr.show');
        Route::post('/store', [DVRController::class, "store"])->name('dvr.store');
        Route::get('/edit/{id}', [DVRController::class, "edit"])->name('dvr.edit');
        Route::any('/update/{id}', [DVRController::class, "update"])->name('dvr.update');
        Route::any('/delete/{id}', [DVRController::class, "destroy"])->name('dvr.destroy');
    });
    Route::prefix('tickets')->group(function () {
        Route::get('/index', [TicketController::class, "index"])->name('tickets.index');
        Route::get('/create', [TicketController::class, "create"])->name('ticket.create');
        Route::get('/show/{id}', [TicketController::class, "show"])->name('ticket.show');
        Route::post('/store', [TicketController::class, "store"])->name('ticket.store');
        Route::get('/edit/{id}', [TicketController::class, "edit"])->name('ticket.edit');
        Route::any('/update/{id}', [TicketController::class, "update"])->name('ticket.update');
        Route::any('/delete/{id}', [TicketController::class, "destroy"])->name('ticket.destroy');
    });
    Route::prefix('vps')->group(function () {
        Route::get('/index', [VpController::class, "index"])->name('vps.index');
        Route::get('/show/{id}', [VpController::class, "show"])->name('vp.show');
        Route::get('/create', [VpController::class, "create"])->name('vp.create');
        Route::post('/store', [VpController::class, "store"])->name('vp.store');
        Route::get('/edit/{id}', [VpController::class, "edit"])->name('vp.edit');
        Route::post('/update/{id}', [VpController::class, "update"])->name('vp.update');
        Route::any('/delete/{id}', [VpController::class, "destroy"])->name('vp.destroy');
    });
    Route::prefix('types')->group(function () {
        Route::get('/index', [TypeController::class, "index"])->name('types.index');
        Route::get('/show/{id}', [TypeController::class, "show"])->name('type.show');
        Route::get('/create', [TypeController::class, "create"])->name('type.create');
        Route::post('/store', [TypeController::class, "store"])->name('type.store');
        Route::get('/edit/{id}', [TypeController::class, "edit"])->name('type.edit');
        Route::post('/update/{id}', [TypeController::class, "update"])->name('type.update');
        Route::any('/delete/{id}', [TypeController::class, "destroy"])->name('type.destroy');
    });
    Route::prefix('titles')->group(function () {
        Route::get('/index', [TitleController::class, "index"])->name('titles.index');
        Route::get('/show/{id}', [TitleController::class, "show"])->name('title.show');
        Route::get('/create', [TitleController::class, "create"])->name('title.create');
        Route::post('/store', [TitleController::class, "store"])->name('title.store');
        Route::get('/edit/{id}', [TitleController::class, "edit"])->name('title.edit');
        Route::any('/update/{id}', [TitleController::class, "update"])->name('title.update');
        Route::any('/delete/{id}', [TitleController::class, "destroy"])->name('title.destroy');
    });
    Route::prefix('areas')->group(function () {
        Route::get('/index', [AreaController::class, "index"])->name('areas.index');
        Route::get('/show/{id}', [AreaController::class, "show"])->name('area.show');
        Route::get('/create', [AreaController::class, "create"])->name('area.create');
        Route::post('/store', [AreaController::class, "store"])->name('area.store');
        Route::get('/edit/{id}', [AreaController::class, "edit"])->name('area.edit');
        Route::post('/update/{id}', [AreaController::class, "update"])->name('area.update');
        Route::any('/delete/{id}', [AreaController::class, "destroy"])->name('area.destroy');
    });
    Route::prefix('workers')->group(function () {
        Route::get('/index', [WorkerController::class, "index"])->name('workers.index');
        Route::get('/create', [WorkerController::class, "create"])->name('worker.create');
        Route::get('/show/{id}', [WorkerController::class, "show"])->name('worker.show');
        Route::post('/store', [WorkerController::class, "store"])->name('worker.store');
        Route::get('/edit/{id}', [WorkerController::class, "edit"])->name('worker.edit');
        Route::post('/update/{id}', [WorkerController::class, "update"])->name('worker.update');
        Route::any('/delete/{id}', [WorkerController::class, "destroy"])->name('worker.destroy');
        Route::post('/workers/export', [WorkerController::class, "export"])->name('workers.export');
    });
    Route::prefix('locations')->group(function () {
        Route::get('/index', [LocationController::class, "index"])->name('locations.index');
        Route::get('/create', [LocationController::class, "create"])->name('location.create');
        Route::get('/show/{id}', [LocationController::class, "show"])->name('location.show');
        Route::post('/store', [LocationController::class, "store"])->name('location.store');
        Route::get('/edit/{id}', [LocationController::class, "edit"])->name('location.edit');
        Route::post('/update/{id}', [LocationController::class, "update"])->name('location.update');
        Route::any('/delete/{id}', [LocationController::class, "destroy"])->name('location.destroy');
    });
    Route::prefix('countries')->group(function () {
        Route::get('/index', [CountryController::class, "index"])->name('countries.index');
        Route::get('/create', [CountryController::class, "create"])->name('country.create');
        Route::get('/show/{id}', [CountryController::class, "show"])->name('country.show');
        Route::post('/store', [CountryController::class, "store"])->name('country.store');
        Route::get('/edit/{id}', [CountryController::class, "edit"])->name('country.edit');
        Route::post('/update/{id}', [CountryController::class, "update"])->name('country.update');
        Route::any('/delete/{id}', [CountryController::class, "destroy"])->name('country.destroy');
    });
    Route::prefix('drivers')->group(function () {
        Route::get('/index', [DriverController::class, "index"])->name('drivers.index');
        Route::get('/create', [DriverController::class, "create"])->name('driver.create');
        Route::get('/show/{id}', [DriverController::class, "show"])->name('driver.show');
        Route::post('/store', [DriverController::class, "store"])->name('driver.store');
        Route::get('/edit/{id}', [DriverController::class, "edit"])->name('driver.edit');
        Route::post('/update/{id}', [DriverController::class, "update"])->name('driver.update');
        Route::any('/delete/{id}', [DriverController::class, "destroy"])->name('driver.destroy');
    });
    Route::prefix('/haulers')->group(function () {
        Route::get('/index', [HaulerController::class, "index"])->name('haulers.index');
        Route::get('/create', [HaulerController::class, "create"])->name('hauler.create');
        Route::get('/show/{id}', [HaulerController::class, "show"])->name('hauler.show');
        Route::post('/store', [HaulerController::class, "store"])->name('hauler.store');
        Route::get('/edit/{id}', [HaulerController::class, "edit"])->name('hauler.edit');
        Route::post('/update/{id}', [HaulerController::class, "update"])->name('hauler.update');
        Route::post('/delete/{id}', [HaulerController::class, "destroy"])->name('hauler.destroy');
        Route::get('/changestate/{id}', [HaulerController::class, "changestate"])->name('hauler.changestate');
    });
    Route::prefix('trucks')->group(function () {
        Route::get('/index', [TruckController::class, "index"])->name('trucks.index');
        Route::get('/create', [TruckController::class, "create"])->name('truck.create');
        Route::get('/show/{id}', [TruckController::class, "show"])->name('truck.show');
        Route::post('/store', [TruckController::class, "store"])->name('truck.store');
        Route::get('/edit/{id}', [TruckController::class, "edit"])->name('truck.edit');
        Route::post('/update/{id}', [TruckController::class, "update"])->name('truck.update');
        Route::any('/delete/{id}', [TruckController::class, "destroy"])->name('truck.destroy');
    });
    Route::prefix('groups')->group(function () {
        Route::get('/index', [GroupController::class, "index"])->name('groups.index');
        Route::get('/create', [GroupController::class, "create"])->name('group.create');
        Route::get('/show/{id}', [GroupController::class, "show"])->name('group.show');
        Route::post('/store', [GroupController::class, "store"])->name('group.store');
        Route::get('/edit/{id}', [GroupController::class, "edit"])->name('group.edit');
        Route::post('/update/{id}', [GroupController::class, "update"])->name('group.update');
        Route::any('/delete/{id}', [GroupController::class, "destroy"])->name('group.destroy');
    });
    Route::prefix('egy/violations')->group(function () {
        Route::get('/index', [ViolationController::class, "index"])->name('violations.index');
        Route::get('/myarea', [ViolationController::class, 'myArea'])->name('violations.myarea');
        Route::get('/create', [ViolationController::class, "create"])->name('violations.create');
        Route::post('/store', [ViolationController::class, "store"])->name('violations.store');
        Route::get('/edit/{id}', [ViolationController::class, "edit"])->name('violations.edit');
        Route::get('/show/{id}', [ViolationController::class, "show"])->name('violations.show');
        Route::post('/update/{id}', [ViolationController::class, "update"])->name('violations.update');
        Route::any('/delete/{id}', [ViolationController::class, "destroy"])->name('violations.destroy');
        Route::post('/search', [ViolationController::class, "indexDate"])->name('violations.search');
        Route::get('/search/{type}', [ViolationController::class, "indexType"])->name('violations.searchType');
        Route::get('/search/{type}/{date_from}/{date_to}', [ViolationController::class, "indexDateType"])->name('violations.searchDateType');
        Route::post('/nearmiss', [ViolationController::class, "search"])->name('violations.nearmiss.search');
        Route::get('/exportdate', [ViolationController::class, "exportDate"])->name('violations.exportdate');
        Route::get('/export', [ViolationController::class, 'export'])->name('violations.export');
    });
    Route::prefix('uae/violations')->group(function () {
        Route::get('/index', [UaeViolationController::class, "index"])->name('uae.violations.index');
        Route::get('/create', [UaeViolationController::class, "create"])->name('uae.violations.create');
        Route::post('/store', [UaeViolationController::class, "store"])->name('uae.violations.store');
        Route::get('/edit/{id}', [UaeViolationController::class, "edit"])->name('uae.violations.edit');
        Route::get('/show/{id}', [UaeViolationController::class, "show"])->name('uae.violations.show');
        Route::post('/update/{id}', [UaeViolationController::class, "update"])->name('uae.violation.update');
        Route::any('/delete/{id}', [UaeViolationController::class, "destroy"])->name('uae.violations.destroy');
        Route::post('/search', [UaeViolationController::class, "indexDate"])->name('uae.violations.search');
        Route::get('/search/{type}', [UaeViolationController::class, "indexType"])->name('uae.violations.searchType');
        Route::get('/search/{type}/{date_from}/{date_to}', [UaeViolationController::class, "indexDateType"])->name('uae.violations.searchDateType');
        Route::get('/exportdate', [UaeViolationController::class, "exportDate"])->name('uae.violations.exportdate');
        Route::get('/export', [UaeViolationController::class, 'export'])->name('uae.violations.export');
        /*
        Route::get('search/', function ($type) {
            $classification = ViolationType::where('classification',  $type)->first();
            dd($type);
        })->name('uae.violations.searchType'); */
    });
    Route::prefix('safety')->group(function () {
        Route::get('/index', [SafetyController::class, "index"])->name('safety.violations.comment');
        Route::get('/show/{id}/comment', [SafetyController::class, "create"])->name('safety.comment');
        Route::post('/show/{id}/comment', [SafetyController::class, "store"])->name('safety.comment.store');
    });
    Route::prefix('reports')->group(function () {
        Route::get('/violations', [ReportController::class, "index"])->name('report.violations.index');
        Route::get('/myviolations', [ViolationController::class, "myviolations"])->name('report.myviolations');
        Route::post('/violations/monthly', [ViolationController::class, "monthly"])->name('report.monthly.violations');
    });
    Route::prefix('companies')->group(function () {
        Route::get('/index', [CompanyController::class, "index"])->name('companies.index');
        Route::get('/create', [CompanyController::class, "create"])->name('company.create');
        Route::post('/store', [CompanyController::class, "store"])->name('company.store');
        Route::get('/edit/{id}', [CompanyController::class, "edit"])->name('company.edit');
        Route::post('/update/{id}', [CompanyController::class, "update"])->name('company.update');
        Route::get('/show/{id}', [CompanyController::class, "show"])->name('company.show');
        Route::get('/destroy/{id}', [CompanyController::class, "destroy"])->name('company.destroy');
    });
    Route::prefix('service/companies')->group(function () {
        Route::get('/index', [ServiceCompanyController::class, "index"])->name('service.companies.index');
        Route::get('/create', [ServiceCompanyController::class, "create"])->name('service.company.create');
        Route::post('/store', [ServiceCompanyController::class, "store"])->name('service.company.store');
        Route::get('/edit/{id}', [ServiceCompanyController::class, "edit"])->name('service.company.edit');
        Route::post('/update/{id}', [ServiceCompanyController::class, "update"])->name('service.company.update');
        Route::get('/show/{id}', [ServiceCompanyController::class, "show"])->name('service.company.show');
        Route::get('/destroy/{id}', [ServiceCompanyController::class, "destroy"])->name('service.company.destroy');
    });
    Route::prefix('service/unfixed/permits')->group(function () {
        Route::get('/index', [UnfixedPermitController::class, "index"])->name('unfixed.permits.index');
        Route::get('/create', [UnfixedPermitController::class, "create"])->name('unfixed.permit.create');
        Route::post('/store', [UnfixedPermitController::class, "store"])->name('unfixed.permit.store');
        Route::get('/edit/{id}', [UnfixedPermitController::class, "edit"])->name('unfixed.permit.edit');
        Route::post('/update/{id}', [UnfixedPermitController::class, "update"])->name('unfixed.permit.update');
        Route::get('/show/{id}', [UnfixedPermitController::class, "show"])->name('unfixed.permit.show');
        Route::get('/destroy/{id}', [UnfixedPermitController::class, "destroy"])->name('unfixed.permit.destroy');
        Route::get('/safety/index', [UnfixedPermitController::class, "safetyUnfixedindex"])->name('unfixed.safety.permit.index');
        Route::get('/security/index', [UnfixedPermitController::class, "securityUnfixedindex"])->name('unfixed.security.permit.index');
    });
    Route::prefix('/unfixed/service')->group(function () {
        Route::get('/index', [UnfixedServiceController::class, "index"])->name('unfixed.emps.index');
        Route::get('/create', [UnfixedServiceController::class, "create"])->name('unfixed.emp.create');
        Route::post('/store', [UnfixedServiceController::class, "store"])->name('unfixed.emp.store');
        Route::get('/edit/{id}', [UnfixedServiceController::class, "edit"])->name('unfixed.emp.edit');
        Route::post('/update/{id}', [UnfixedServiceController::class, "update"])->name('unfixed.emp.update');
        Route::get('/show/{id}', [UnfixedServiceController::class, "show"])->name('unfixed.emp.show');
        Route::get('/destroy/{id}', [UnfixedServiceController::class, "destroy"])->name('unfixed.emp.destroy');
    });
    Route::prefix('switches')->group(function () {
        Route::get('/index', [DispatchController::class, "index"])->name('switches.index');
        Route::get('/create', [DispatchController::class, "create"])->name('switch.create');
        Route::post('/store', [DispatchController::class, "store"])->name('switch.store');
        Route::get('/edit/{id}', [DispatchController::class, "edit"])->name('switch.edit');
        Route::post('/update/{id}', [DispatchController::class, "update"])->name('switch.update');
        Route::get('/show/{id}', [DispatchController::class, "show"])->name('switch.show');
        Route::get('/destroy/{id}', [DispatchController::class, "destroy"])->name('switch.destroy');
    });
    Route::prefix('vlans')->group(function () {
        Route::get('/index', [VlanController::class, "index"])->name('vlans.index');
        Route::get('/create', [VlanController::class, "create"])->name('vlan.create');
        Route::post('/store', [VlanController::class, "store"])->name('vlan.store');
        Route::get('/edit/{id}', [VlanController::class, "edit"])->name('vlan.edit');
        Route::post('/update/{id}', [VlanController::class, "update"])->name('vlan.update');
        Route::get('/show/{id}', [VlanController::class, "show"])->name('vlan.show');
        Route::get('/destroy/{id}', [VlanController::class, "destroy"])->name('vlan.destroy');
    });
    Route::prefix('permits')->group(function () {
        Route::get('/truck/create', [PermitController::class, "truckCreate"])->name('permits.vehicle.create');
        Route::post('/trucks/store', [PermitController::class, "truckPermitStore"])->name('permits.vehicle.store');
        Route::get('/private/create', [PermitController::class, "privateCreate"])->name('permits.private.create');
        Route::post('/private/store', [PermitController::class, "PrivatePermitStore"])->name('permits.private.store');
        //Route::get('/approved', [PermitController::class, "approvedpermits"])->name('permits.approved');
        //Route::get('/rejected', [PermitController::class, "refusedpermits"])->name('permits.rejected');
        Route::get('/mypermit', [PermitController::class, "myPermit"])->name('permits.mypermits');
        Route::get('/private/index', [PermitController::class, "privateindex"])->name('permits.private.index');
        Route::get('/vehicle/index', [PermitController::class, "vehicleindex"])->name('permits.vehicle.index');
        Route::post('/store', [PermitController::class, "store"])->name('permits.store');
        Route::get('/trucks/myteam', [PermitController::class, "truckmyteam"])->name('permits.trucks.myteam');
        Route::get('/private/myteam', [PermitController::class, "privatemyteam"])->name('permits.private.myteam');
        Route::any('/show/{id}', [PermitController::class, "show"])->name('permits.show');
        Route::any('/approve/{id}', [PermitController::class, "approve"])->name('permit.approve');
        Route::any('/refuse/{id}', [PermitController::class, "refuse"])->name('permit.refuse');
        Route::any('/delete/{id}', [PermitController::class, "destroy"])->name('permit.destroy');
        Route::any('/show/{id}', [PermitController::class, "show"])->name('permit.show');
        Route::any('/today', [PermitController::class, "today"])->name('permits.today');
    });
});
