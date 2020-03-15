<?php

use Annotations\AnnotationParser;


function propertyHasAnnotation($class, string $propertyName, string $annotation)
{

    $reflectionClass = new ReflectionClass($class);

    $docComment = $reflectionClass->getProperty($propertyName)->getDocComment();

    return AnnotationParser::hasAnnotation($docComment, $annotation);

}