<?php

namespace App\ParamConverter;

use App\DataTransferObjects\SearchCategory;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Request;

class ParamConverterSearchCategory implements ParamConverterInterface
{

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(ConfigurationInterface $configuration)
    {

        if ($configuration->getClass() != SearchCategory::class) {
            return false;
        }
        return true;
    }

    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $class = $configuration->getClass();

        $object = $this->serializer->deserialize(
            $request->getContent(),
            $class,
            'json'
        );

        $request->attributes->set($configuration->getName(), $object);
    }

}
