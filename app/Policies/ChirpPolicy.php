<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // 例えば、すべての認証済みユーザーが作成できる場合
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chirp $chirp): bool
    {
        // ユーザーがモデルの作成者であるか、または特別な権限を持つ場合
        return $user->id === $chirp->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Check if the user owns the chirp or has some admin privileges
        return true; // 例えば、すべての認証済みユーザーが作成できる場合
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        // ユーザーがモデルの作成者であるか、または特別な権限を持つ場合
        return $user->id === $chirp->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        // ユーザーがモデルの作成者であるか、または特別な権限を持つ場合
        return $user->id === $chirp->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        // ユーザーがモデルの作成者であるか、または特別な権限を持つ場合
        return $user->id === $chirp->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        // ユーザーがモデルの作成者であるか、または特別な権限を持つ場合
        return $user->id === $chirp->user_id;
    }
}
