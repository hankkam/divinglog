<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class BinaryValueToArrayTransformer implements DataTransformerInterface
{
    /** @var callable */
    private $transform;

    /** @var callable */
    private $reverseTransform;

    private $binaryValueArray = array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536);

    /**
     * Constructor.
     *
     * @param callable $transform
     * @param callable $reverseTransform
     */
    public function __construct(callable $transform, callable $reverseTransform)
    {
        $this->transform = $transform;
        $this->reverseTransform = $reverseTransform;
    }

    private function subsetSum($array, $binaryValue, $i = 0)
    {
        $result = array();
        while ($i < count($array)) {

            $arrayValue = $array[$i];

            if ($arrayValue == $binaryValue) {
                $result[] = $arrayValue;
            }

            if ($arrayValue < $binaryValue) {
                foreach ($this->subsetSum($array, $binaryValue - $arrayValue, $i + 1) as $subsetSum) {
                    $result[] = "$arrayValue+$subsetSum";
                }
            }
            $i++;
        }

        return $result;
    }

    public function transform($data)
    {
        $result = $this->subsetSum($this->binaryValueArray, $data);

        return (empty($result)) ? array() : explode("+", $result[0]);
    }

    public function reverseTransform($data)
    {
        return array_sum($data);
    }
}