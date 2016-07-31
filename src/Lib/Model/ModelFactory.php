<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Lib\Model;


class ModelFactory
{
    // a map of model names to factory closures
    protected $map = [];

    public function __construct($map = [])
    {
        $this->map = $map;
    }

    public function get($modelName)
    {
        /** @var \Aura\Di\Injection\Factory $diFactory */
        $diFactory = $this->map[$modelName];
        $model = $diFactory();
        return $model;
    }

}