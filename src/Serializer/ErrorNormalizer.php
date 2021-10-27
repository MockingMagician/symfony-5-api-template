<?php

/**
 * @author Marc MOREAU <to-define>
 * @license private
 * @link https://github.com/<to-define>/README.md
 */

namespace App\Serializer;

use App\Kernel;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @codeCoverageIgnore
 */
class ErrorNormalizer implements NormalizerInterface
{
    private Kernel $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var FlattenException $object */
        $error = [
            'message' => 'Error',
            'exception' => [
                'message' => $object->getMessage(),
                'code' => $object->getStatusCode(),
            ],
        ];

        if (in_array($this->kernel->getEnvironment(), ['dev'])) {
            $error['exception']['stack_trace'] = $object->getTrace();
        }

        return $error;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof FlattenException;
    }
}
