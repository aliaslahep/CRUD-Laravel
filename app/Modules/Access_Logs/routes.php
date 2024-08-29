<?php 

use App\Modules\Access_Logs\Controllers\AccessLogController;

Route::group(['prefix' => 'module-one', 'namespace' => 'App\Modules\ModuleOne\Controllers'], function () {
    Route::get('/', [AccessLogController::class, 'index'])->name('module-one.index');
    Route::get('model-test', [AccessLogController::class, 'modelTest'])->name('module-one.modelTest');
    Route::get('model-test-two', [AccessLogController::class, 'modelTestTwo'])->name('module-one.modelTestTwo');
});

Route::get('/access-log', [AccessLogController::class, 'access_log'])->name('access_log');

Route::post('/access-log', [AccessLogController::class, 'filter_log'])->name('filter_log');

Route::get('generate-pdf/{user_id}/{url}/{from}/{to}', [AccessLogController::class, 'generate_pdf'])->name('generate_pdf');

Route::get('generate-excel/{user_id}/{url}/{from}/{to}', [AccessLogController::class, 'generate_excel'])->name('generate_excel');

Route::get('upload-log', [AccessLogController::class, 'upload_log'])->name('upload_log');

Route::post('upload-log', [AccessLogController::class, 'file_upload'])->name('file_upload');

Route::get('upload-excel', [AccessLogController::class, 'upload_excel'])->name('upload_excel');

