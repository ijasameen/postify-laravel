<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProfileLayout extends Component
{
    public function __construct(public User $profileOwner) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $data['overviewRoute'] = route('profile', ['user' => $this->profileOwner->username], false);
        $data['postsRoute'] = route('profile.posts', ['user' => $this->profileOwner->username], false);
        $data['repliesRoute'] = route('profile.replies', ['user' => $this->profileOwner->username], false);
        $data['savedRoute'] = route('profile.saved', ['user' => $this->profileOwner->username], false);

        $data['isOverviewActive'] = request()->is(substr($data['overviewRoute'], 1));
        $data['isPostsActive'] = request()->is(substr($data['postsRoute'], 1));
        $data['isRepliesActive'] = request()->is(substr($data['repliesRoute'], 1));
        $data['isSavedActive'] = request()->is(substr($data['savedRoute'], 1));

        return view('layouts.profile', $data);
    }
}
