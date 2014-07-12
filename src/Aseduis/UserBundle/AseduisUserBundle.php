<?php

namespace Aseduis\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AseduisUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
