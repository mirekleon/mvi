<?php

namespace MVI\Component\Base;

use MVI\Exception\MviException;

/**
 * This file is part of the MVI package.
 *
 * Copyright (c) Qualcomm
 */
trait MagicTrait
{
    /**
     * {@inheritdoc}
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            parent::setMultiVendorCallerMethod(
                get_method_name_from_stack(debug_backtrace())
            );
            return $this->request();
        }
        throw new MviException(
            sprintf(
                'Property "%s->%s" not found!',
                $this->getMultiVendorCallerClass(),
                $name
            )
        );
    }
}