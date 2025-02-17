<?php

use App\Jobs\UnbanUser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

uses(TestCase::class);
uses(DatabaseMigrations::class);

it('can unban a user', function () {
    $user = $this->createUser(['banned_at' => Carbon::yesterday(), 'banned_reason' => 'test']);

    $this->dispatch(new UnbanUser($user));

    $unbannedUser = $user->fresh();

    expect($unbannedUser->isBanned())->toBeFalse()
	->and($unbannedUser->hasBannedReason())->toBeFalse();
});
