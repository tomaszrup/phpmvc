<?php

namespace Annotations;

class AnnotationParser
{

    static function hasAnnotation($docComment, $annotation)
    {

        $docComment = str_replace("*", "", $docComment);
        $docComment = substr($docComment, 1, -1);
        $docComment = trim($docComment);

        $annotationsArray = preg_split('/\s+/', $docComment);

        return in_array($annotation, $annotationsArray);

    }

    private function __construct()
    {
    }


}