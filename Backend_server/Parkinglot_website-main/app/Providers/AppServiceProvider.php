<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\MQTTdoit;
use Illuminate\Support\Facades\Request; // Thêm dòng này

use Illuminate\Pagination\Paginator;
//use App\Models\Slot;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { 
        $something = new MQTTdoit();


        $something->dosomething();


    if (env('APP_ENV') ==='production' )
    {

$url = Request::url();

$check = strstr($url, "http:://");
if ($check)
{
$newUrl= str_replace("http","https",$url);
header("Location: ". $newUrl);


}
    }




    }
}
