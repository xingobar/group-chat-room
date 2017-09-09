<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/*
 * we are listening on private channel, we need to authenticate that the currently logged
 * in user is able to listen on this private channel. Laravel Echo will automatically call
 * the necessary authorization routes if we are listening to a private channel.
 *
 */

Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('group.{group}',function($user,Group $group){
   return $group->hasUser($user->id);
});
