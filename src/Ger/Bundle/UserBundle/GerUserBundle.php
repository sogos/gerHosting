<?php

namespace Ger\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GerUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
