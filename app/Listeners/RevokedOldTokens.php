<?php

namespace App\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;

class RevokedOldTokens
{
    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated $event
     * @return void
     */
    public function handle(AccessTokenCreated $event) {
        $token = Token::where('id', '!=', $event->tokenId);
        $token->where('user_id', $event->userId);
        $token->where('client_id', $event->clientId);
        $token->where('revoked', 0);
        $token->update(['revoked' => 1]);
    }
}
