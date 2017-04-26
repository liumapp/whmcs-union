<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../../../vendor/autoloadLiumapp.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
