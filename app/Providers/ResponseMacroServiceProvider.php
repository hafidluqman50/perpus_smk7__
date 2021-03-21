<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('attachment', function ($content) {
            // dd($content);

            // $headers = [
            //     'Content-type'        => 'application/vnd.ms-excel',
            //     'Content-Disposition' => 'attachment; filename="download.xlsx"',
            // ];

            // return Response::make($content, 200, $headers);

            $response = Response::make($content, 200);

            $response->header('Content-Type', 'application/vnd.ms-excel');
            $response->header('Content-Disposition', 'attachment; filename="download.xlsx"');

            return $response;

        });
    }
}
