<?php

namespace WSL\Persistent\Storage;

class Transient extends StorageAbstract {

    public function __construct($user_id = false) {
        if ($user_id === false) {
            $user_id = get_current_user_id();
        }
        $this->sessionId = 'wooslg_persistent_' . $user_id;
    }
}