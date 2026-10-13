<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
//https://www.php.net/manual/en/class.reflectionclass.php
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = []; //singelton pattern. Created to track instances.

    public function addDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    //validate class
    {
        $reflectionClass = new ReflectionClass($className);

        //является ли переданный класс - вызываемым?
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        //есть ли у него construct?
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $className;
        }

        $params = $constructor->getParameters();
        //есть ли параметры?
        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name");
            }

            //Для HomeController, например, $type->getName() вернет "Framework\TemplateEngine", а для него в container-definitions.php задано с каким аргументом создавать экземпляр.
            $dependencies[] = $this->get($type->getName());
        }

        /* создаем экземпляр класса, напр, HomeController с необходимыми значениями у свойств. Значения определяются в $dependencies.
        Так, например, в $dependencies будет лежать экземпляр TemplateEngine. Соот-но, экземпляр HomeController будет создан со свойством view, и во view пойдет в кач-ве значения наш экземпляр TemplateEngine. */

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    // method responsible for instanciating the dependency
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in container");
        }

        // singleton pattern, check if existing instance.
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];
        $dependency = $factory();

        $this->resolved[$id] = $dependency; //signleton pattern. store instance in a resolved

        return $dependency;
    }
}
