<?php

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('online', function (User $user) {
    return $user ?  new UserResource($user) : null;
});

Broadcast::channel('message.user.{userId}-{userId2}', function (User $user, int $userId, int $userId2) {
    return $user->id === $userId || $user->id === $userId2 ? $user : null;
});

Broadcast::channel('message.group.{groupId}', function (User $user, int $groupId) {
    return $user->groups->contains('id', $groupId) ? $user : null;
});
