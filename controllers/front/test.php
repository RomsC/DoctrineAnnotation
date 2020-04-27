<?php

use Doctrine\Common\Annotations\AnnotationReader;
use DoctrineAnnotation\Entity\Da_Test;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class doctrineannotationTestModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    /** @var Serializer */
    private $_serializer;

    public function __construct()
    {
        parent::__construct();
        $classMetadataFactory = new ClassMetadataFactory(
            new AnnotationLoader(new AnnotationReader())
        );
        $objectNormalizer = new ObjectNormalizer($classMetadataFactory);
        $this->_serializer = new Serializer([
            new JsonSerializableNormalizer(),
            new ArrayDenormalizer(),
            new DateTimeNormalizer(),
            $objectNormalizer
        ], [
            new JsonEncode(),
        ]);
    }


    public function initContent(): void
    {
        parent::initContent();

        $test = $this->get('doctrine.orm.entity_manager')->getRepository(Da_Test::class)->find(1);

        $json = $this->_serializer->serialize(
            $test,
            'json',
            ['groups' => ['test:read']]
        );

        $this->context->smarty->assign([
            'json' => $json
        ]);
        $this->setTemplate('module:doctrineannotation/views/templates/front/test.tpl');
    }

    /**
     * overrides full with layout
     *
     * @return bool|string
     */
    public function getLayout()
    {
        return 'layouts/layout-full-width.tpl';
    }
}
