<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
/* if need, change to this:
Broadcast::channel('management.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('transport_information',function() {

});

Broadcast::channel( 'Admin.{id}',function(User $user,$id){
    return (int) $user->id === (int) $id;

});

// register your application's broadcast authorization routes and callbacks.