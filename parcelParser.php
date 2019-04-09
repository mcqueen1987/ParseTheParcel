<?php

/**
 * Class Specification
 */
class Specification
{
    private $breadth;
    private $height;
    private $length;
    private $weight;
    private $type;
    private $cost;

    /**
     * @return mixed
     */
    public function getBreadth()
    {
        return $this->breadth;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Specification constructor.
     * @param $breadth
     * @param $height
     * @param $length
     * @param $weight
     * @param $cost
     * @param $type
     */
    public function __construct($breadth, $height, $length, $weight, $cost, $type)
    {
        $this->breadth = $breadth;
        $this->height = $height;
        $this->length = $length;
        $this->weight = $weight;
        $this->cost = $cost;
        $this->type = $type;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function isMatch(product $product)
    {
        if (
            $product->getBreadth() > $this->breadth ||
            $product->getHeight() > $this->height ||
            $product->getLength() > $this->length ||
            $product->getWeight() > $this->weight
        ) {
            return false;
        }
        return true;
    }
}

/**
 * Class Product
 */
class Product
{
    private $breadth;
    private $height;
    private $length;
    private $weight;

    /**
     * @return mixed
     */
    public function getBreadth()
    {
        return $this->breadth;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Product constructor.
     * @param $breadth
     * @param $height
     * @param $length
     * @param $weight
     * @throws Exception
     */
    public function __construct($breadth, $height, $length, $weight)
    {
        $this->breadth = $breadth;
        $this->height = $height;
        $this->length = $length;
        $this->weight = $weight;
        if (!$this->_isValidate()) {
            throw new Exception("illegal input info, breadth: $breadth, height: $height, length: $length, weight: $weight");
        }
    }

    /**
     * check the legality of parcel params
     *
     * @return bool
     */
    private function _isValidate()
    {
        $parcelDimensions = [$this->breadth, $this->height, $this->length];
        if (
            !is_int($this->weight) ||
            $this->weight <= 0
        ) {
            return false;
        }

        $filteredArr = array_filter($parcelDimensions, function ($item) {
            return is_int($item) && $item > 0;
        });
        if (
            count($parcelDimensions) != count($filteredArr)
        ) {
            return false;
        }
        return true;
    }
}

/**
 * shipping costs calculation, based on size and weight info .etc
 *
 * Class ParseTheParcel
 */
class ParcelParser
{
    /**
     * specifications list
     *
     * @var array
     */
    private $specifications = [];

    /**
     * @return array
     */
    public function getSpecifications()
    {
        return $this->specifications;
    }

    /**
     * ParcelParser constructor.
     * @param array $specifications
     */
    public function __construct($specifications = [])
    {
        if (!empty($specifications)) {
            $this->append($specifications);
        }
    }

    /**
     * @param $specifications array
     */
    public function append($specifications)
    {
        $this->specifications = array_merge($this->specifications, $specifications);
        usort($this->specifications, function ($a, $b) {
            return $a->getBreadth() - $b->getBreadth();
        });
    }

    /**
     * @param Product $product
     * @return array|bool
     */
    public function getSpecificationByProduct(product $product)
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isMatch($product)) {
                return [
                    $specification->getCost(),
                    $specification->getType()
                ];
            }
        }
        return false;
    }
}
