<?php

namespace IWD\JobInterview\Repository;

use IWD\JobInterview\Service\JSON\DataHandler;
use PHPUnit\Framework\Exception;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BaseJsonRepository implements DataHandler
{
    private $serializer;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    function isJson($string) {
        try{
            json_decode($string);
        } catch (Exception $e){
            return false;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }

    function getAllJSON($directory)
    {
        $finder = new Finder();
        return $finder->files()->name('*.json')->in($directory);
    }

    function serialize($object)
    {
        return $this->serializer->serialize($object, 'json');
    }

    function deserialize($content, $objectType)
    {
        return $this->serializer->deserialize($content, $objectType, 'json');
    }
}
