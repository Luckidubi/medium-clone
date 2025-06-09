<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function followUnfollow(User $user)
    {
        $authUser = Auth::user();

        // Prevent self-follow
        if ($authUser->id === $user->id) {
            return response()->json(['message' => 'Cannot follow yourself'], 422);
        }

        // Toggle the follow status
        $result = $authUser->followings()->toggle($user->id);

        // Determine new follow status
        $isFollowing = !empty($result['attached']);

        return response()->json([
            'message' => $isFollowing
                ? 'Followed user successfully.'
                : 'Unfollowed user successfully.',
            'following' => $isFollowing,
            'follower_count' => $user->followers()->count(),
        ]);
    }

}
