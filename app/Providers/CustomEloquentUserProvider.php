<?php
namespace App\Providers;

use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Auth\EloquentUserProvider as BaseEloquentUserProvider;

class CustomEloquentUserProvider extends BaseEloquentUserProvider {

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected $model;

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $model
     * @return void
     */
    public function __construct(HasherContract $hasher, $model) {
        $this->model = $model;
        $this->hasher = $hasher;
        parent::__construct($this->hasher, $this->model);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials($user, array $credentials): bool {
        // Récupérer l'utilisateur par l'email ou le login
        $user = User::where('email', $credentials['email'] ?? '')->orWhere('login', $credentials['login'] ?? '')->with('usersRole')->first();
        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user) {
            // Comparer les mots de passe
            if ((new Utils())->signature(htmlspecialchars($credentials['password'])) === $user->password) {
                return true;
            }
        }

        return false;
    }

}

