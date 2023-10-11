<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserPermissionController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

//categories
Route::get('all-categories', [CategoryController::class, 'allCategories'])->name('all-categories');
Route::get('create-category', [CategoryController::class, 'createCategory'])->name('create-category');
Route::post('store-category', [CategoryController::class, 'storeCategory'])->name('store-category');
Route::get('category-edit/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
Route::put('category-update/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
Route::delete('/category-delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');

//user management
Route::get('all-users', [UserController::class, 'allUsers'])->name('all-users');
Route::get('create-user', [UserController::class, 'createUser'])->name('create-user');
Route::post('store-user',[UserController::class, 'storeUser'])->name('store-user');

Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('edit-user');
Route::put('update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::delete('delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

//permissions management
Route::get('all-permissions', [PermissionController::class, 'allPermissions'])->name('all-permissions');
Route::post('store-permission', [PermissionController::class, 'storePermission'])->name('store-permission');
Route::get('create-premission', [PermissionController::class, 'createPermission'])->name('create-permission');
Route::get('edit-premission/{id}', [PermissionController::class, 'editPermission'])->name('edit-permission');
Route::put('update-permission/{id}', [PermissionController::class, 'updatePermission'])->name('update-permission');
Route::delete('delete-permission/{id}', [PermissionController::class, 'deletePermission'])->name('delete-permission');

//roles management
Route::get('all-roles', [RoleController::class, 'allRoles'])->name('all-roles');
Route::post('store-role', [RoleController::class, 'storeRole'])->name('store-role');
Route::get('create-role', [RoleController::class, 'createRole'])->name('create-role');
Route::get('edit-role/{id}', [RoleController::class, 'editRole'])->name('edit-role');
Route::put('update-role/{id}', [RoleController::class, 'updateRole'])->name('update-role');
Route::delete('delete-role/{id}', [RoleController::class, 'deleteRole'])->name('delete-role');

//permission and role users
Route::get('/users/{id}/permissions', [UserPermissionController::class, 'createUserPermission'])->name('users-permissions')
->middleware('can:staff-user-permissions');
Route::post('/users/{id}/permissions', [UserPermissionController::class, 'storeUserPermission'])->name('users-permissions-store')
->middleware('can:staff-user-permissions');

//Product Management
Route::get('all-products', [ProductController::class, 'allProducts'])->name('all-products');
Route::get('create-product', [ProductController::class, 'createProduct'])->name('create-product');
Route::post('store-product', [ProductController::class, 'storeProduct'])->name('store-product');
Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
Route::get('edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit-product');
Route::put('update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-product');

//order management
Route::get('all-orders', [AdminController::class, 'allOrders'])->name('all-orders');
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->name('delivered');