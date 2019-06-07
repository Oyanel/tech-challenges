<?php

namespace IWD\JobInterview\Service\JSON;

interface DataHandler
{
    function getAllJSON($directory);

    function serialize($object);

    function deserialize($object, $objectType);

    function isJson($string);
}