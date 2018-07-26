<?php

namespace App\Repositories;

use App\User;

class ProductRepository {

    /**
     * Get all product for user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user) {
        return $user->products()
                        ->orderBy('created_at', 'asc')
                        ->get();
    }

}
