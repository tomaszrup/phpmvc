<?php

namespace Auth;

use Models\Model;

class User extends Model {

    /**
     * @JsonIgnore
     */
    protected $password;
    protected $email;
    protected $username;

}