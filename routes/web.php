<?php

use App\Http\Controllers\ControllerClearCache;
use App\Http\Middleware\SharedView\SharedViewLanguagesMiddleware;
use App\Http\Middleware\SharedView\SharedViewModuleMiddleware;
use App\Http\Middleware\SharedView\SharedViewModulesMiddleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Middleware\AuthMiddleware;
use Modules\Conductors\Http\Controllers\ConductorsController;
use Modules\GroundWires\Http\Controllers\GroundWiresController;
use Modules\Insulators\Http\Controllers\InsulatorsController;
use Modules\Languages\Http\Middleware\LanguageMiddleware;
use Modules\Main\Http\Controllers\MainController;
use Modules\Modules\Http\Middleware\ModulesPrivilegesMiddleware;
use Modules\Projects\Http\Controllers\ProjectsController;
use Modules\Towers\Http\Controllers\TowersController;
use Modules\User\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\UsersController;

///////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/clear', [ControllerClearCache::class, 'clear']);
Route::get('/cache', [ControllerClearCache::class, 'cache']);
///////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/', function () {
    $lang = App::getLocale();
    //dd('public/'.$lang);
    return redirect('/admin');
});
///////////////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware([LanguageMiddleware::class])->group(function () {

    //Module AUTH
    Route::get('/admin', [AuthController::class, 'login'])->name('admin');
    Route::match(['get', 'post'],'login-post', [AuthController::class, 'loginPost']);
    Route::get('forgotten-email', [AuthController::class, 'forgottenEmail']);
    Route::post('forgotten-email-post', [AuthController::class, 'forgottenEmailPost']);
    Route::get('forgotten', [AuthController::class, 'forgotten']);
    Route::post('forgotten-post', [AuthController::class, 'forgottenPost']);
    Route::get('expired', [AuthController::class, 'expired'])->name('expired');
    Route::post('expired-post', [AuthController::class, 'expiredPost']);
    Route::get('registration', [AuthController::class, 'registration'])->name('registration');
    Route::post('registration-post', [AuthController::class, 'registrationPost']);
    Route::get('mfa-code', [AuthController::class, 'mfaCode'])->name('mfa-code');
    Route::post('mfa-code-post', [AuthController::class, 'mfaCodePost']);
    Route::get('mfa', [AuthController::class, 'mfa'])->name('mfa');
    Route::post('mfa-post', [AuthController::class, 'mfaPost']);


    Route::middleware([AuthMiddleware::class])->group(function () {

        //Module AUTH
        Route::get('logout', [AuthController::class, 'logout']);
        //Route::get('browser', [RecordController::class, 'browser']);

        Route::middleware([SharedViewLanguagesMiddleware::class, SharedViewModulesMiddleware::class])->group(function () {
            Route::get('admin/{lang}/main', [MainController::class, 'index'])->name('main');

        });

        //CHECK IF USER HAVE PRIVILEGES TO MODULE
        //====================================================================================================
        Route::middleware([ModulesPrivilegesMiddleware::class])->group(function () {


            Route::middleware([SharedViewLanguagesMiddleware::class, SharedViewModulesMiddleware::class, SharedViewModuleMiddleware::class])
                ->prefix('admin/{lang}/{id_module}')
                ->group(function () {

                    //MODULE USERS
                    Route::prefix('users')
                        ->group(function () {
                            Route::get('/', [UsersController::class, 'index'])->name('users.index');
                            Route::get('edit/{id}', [UsersController::class, 'edit']);
                            Route::put('update/{id}', [UsersController::class, 'update']);
                            Route::get('create', [UsersController::class, 'create']);
                            Route::put('store', [UsersController::class, 'store']);
                            Route::get('show/{id}', [UsersController::class, 'show']);
                            Route::delete('delete/{id}', [UsersController::class, 'destroy']);
                            Route::post('send-email-reg/{id}', [UsersController::class, 'sendEmailReg']);

                            Route::get('index-records/{id}', [UsersController::class, 'indexRecords']);
                            Route::get('create-record/{year}/{id}', [UsersController::class, 'createRecord']);
                            Route::post('store-record/{id}', [UsersController::class, 'storeRecord']);
                            Route::get('edit-record/{year}/{id_record}/{id}', [UsersController::class, 'editRecord']);
                            Route::post('update-record/{id_record}/{id}', [UsersController::class, 'updateRecord']);
                            Route::get('show-record/{id_record}', [UsersController::class, 'showRecord']);
                            Route::delete('delete-record/{id_record}/{id}', [UsersController::class, 'deleteRecord']);

                            Route::post('lock-approve/{id}', [UsersController::class, 'lockApproveRecords']);
                            Route::get('get-activities/{id_project}/{id}', [UsersController::class, 'getActivities']);
                            Route::get('get-assignments/{id_project}/{id}', [UsersController::class, 'getAssignments']);

                            Route::post('add/{id_user}/{id_group}', [UsersController::class, 'addGroupToUser']);
                            Route::post('remove/{id_user}/{id_group}', [UsersController::class, 'removeGroupToUser']);
                        });

                    //MODULE USER
//                    Route::prefix('user')
//                        ->group(function () {
//                            Route::middleware([UserRerouteMiddleware::class])->group(function () {
//                                Route::get('edit')->name('edit');
//                            });
//                            Route::middleware([UserUnauthorizedMiddleware::class])->group(function () {
//                                Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit.user');
//                                Route::put('update/{id}', [UserController::class, 'update']);
//                            });
//
//                        });
                    //.MODULE USER

                    //MODULE PROJECTS
                    Route::prefix('projects')
                        ->group(function () {
                            Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
                            Route::get('edit/{id}', [ProjectsController::class, 'edit']);
                            Route::put('update/{id}', [ProjectsController::class, 'update']);
                            Route::get('create', [ProjectsController::class, 'create']);
                            Route::match(['get','post','put'],'store', [ProjectsController::class, 'store']);
                            Route::match(['get','post','put'],'delete/{id}', [ProjectsController::class, 'destroy']);

                            Route::get('edit_endpoints/{id}', [ProjectsController::class, 'editEndPoints']);
                            Route::put('update_endpoints/{id}', [ProjectsController::class, 'updateEndPoints']);

                            Route::get('edit_points/{id}', [ProjectsController::class, 'editPoints']);

                            Route::match(['get','post','put'],'edit_point/{id}/{id_point}', [ProjectsController::class, 'editPoint']);
                            Route::match(['get','post','put'],'store-point/{id}', [ProjectsController::class, 'storePoint']);
                            Route::match(['get','post','put'],'update-point/{id}/{id_point}', [ProjectsController::class, 'updatePoint']);
                            Route::match(['get','post','delete'],'delete_points/{id}', [ProjectsController::class, 'destroyPoint']);

                            Route::get('show-tower/{id}', [ProjectsController::class, 'showTower']);

                            Route::get('edit_raspres/{id}', [ProjectsController::class, 'editRaspres']);
                            Route::get('edit_zatpol/{id}', [ProjectsController::class, 'editZatpol']);
                            Route::get('edit_gapres/{id}', [ProjectsController::class, 'editGapres']);

                            Route::match(['get','post'],'import_points/{id}', [ProjectsController::class, 'importPoints']);
                            Route::match(['get','post','delete'],'delete_imported_points/{id}', [ProjectsController::class, 'deleteImportedPoints']);

                            Route::match(['get','post'],'towers/{id}', [ProjectsController::class, 'towers']);
                            Route::match(['get','post'],'insulators/{id}', [ProjectsController::class, 'insulators']);

                        });
                    //.MODULE PROJECTS

                    //MODULE TOWERS
                    Route::prefix('towers')
                        ->group(function () {
                            Route::get('/', [TowersController::class, 'index'])->name('towers.index');
                            Route::get('show/{id}', [TowersController::class, 'show']);
                            Route::match(['get', 'post', 'delete'],'delete/{id}', [TowersController::class, 'destroy']);
                            Route::get('edit/{id}', [TowersController::class, 'edit']);
                            Route::put('update/{id}', [TowersController::class, 'update']);
                            Route::get('create', [TowersController::class, 'create']);
                            Route::put('store', [TowersController::class, 'store']);


                        });
                    //.MODULE PROJECTS

                    //MODULE INSULATOR
                    Route::prefix('insulators')
                        ->group(function () {
                            Route::get('/', [InsulatorsController::class, 'index'])->name('insulators.index');
                            Route::get('show/{id}', [InsulatorsController::class, 'show']);
                            Route::match(['get', 'post', 'delete'],'delete/{id}', [InsulatorsController::class, 'destroy']);
                            Route::get('edit/{id}', [InsulatorsController::class, 'edit']);
                            Route::put('update/{id}', [InsulatorsController::class, 'update']);
                            Route::get('create', [InsulatorsController::class, 'create']);
                            Route::put('store', [InsulatorsController::class, 'store']);


                        });
                    //.MODULE INSULATOR


                    //MODULE CONDUCTORS
                    Route::prefix('conductors')
                        ->group(function () {
                            Route::get('/', [ConductorsController::class, 'index'])->name('conductors.index');
                            Route::get('show/{id}', [ConductorsController::class, 'show']);
                            Route::match(['get', 'post', 'delete'],'delete/{id}', [ConductorsController::class, 'destroy']);
                            Route::get('edit/{id}', [ConductorsController::class, 'edit']);
                            Route::put('update/{id}', [ConductorsController::class, 'update']);
                            Route::get('create', [ConductorsController::class, 'create']);
                            Route::put('store', [ConductorsController::class, 'store']);


                        });
                    //.MODULE CONDUCTORS

                    //MODULE GROUNDWIRES
                    Route::prefix('groundwires')
                        ->group(function () {
                            Route::get('/', [GroundWiresController::class, 'index'])->name('groundwires.index');
                            Route::get('show/{id}', [GroundWiresController::class, 'show']);
                            Route::match(['get', 'post', 'delete'],'delete/{id}', [GroundWiresController::class, 'destroy']);
                            Route::get('edit/{id}', [GroundWiresController::class, 'edit']);
                            Route::put('update/{id}', [GroundWiresController::class, 'update']);
                            Route::get('create', [GroundWiresController::class, 'create']);
                            Route::put('store', [GroundWiresController::class, 'store']);


                        });
                    //.MODULE GROUNDWIRES

                });
        });
        //====================================================================================================
    });
});
