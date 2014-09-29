<?php
namespace Auth\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


/** @ODM\Document */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $name;

    /** @ODM\String */
    private $email;

    /** @ODM\ReferenceMany(targetDocument="BlogPost", cascade="all") */
    private $posts = array();

    // ...
}