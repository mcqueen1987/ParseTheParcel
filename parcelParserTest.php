<?php

use PHPUnit\Framework\TestCase;

include_once("parcelParser.php");

/**
 * Class ParcelParserTest
 */
class ParcelParserTest extends TestCase
{
    /**
     * test parcel parser normal input
     */
    public function testParcelParserNormalInput(): void
    {
        $testSmall = new Specification(
            200,
            300,
            150,
            25,
            '$5.00',
            'Small'
        );
        $testMedium = new Specification(
            300,
            400,
            200,
            25,
            '$7.50',
            'Medium'
        );
        $testLarge = new Specification(
            400,
            600,
            250,
            25,
            '$8.50',
            'Large'
        );
        $parcelParser = new ParcelParser([$testLarge, $testSmall, $testMedium]);

        /**
         * test: normal input large
         */
        $product = new Product(
            400,
            600,
            250,
            25
        );
        $this->assertEquals(
            [
                '$8.50',
                'Large'
            ],
            $parcelParser->getSpecificationByProduct($product)
        );

        /**
         * test: normal input small
         */
        $product = new Product(
            1,
            2,
            7,
            3
        );
        $this->assertEquals(
            [
                '$5.00',
                'Small'
            ],
            $parcelParser->getSpecificationByProduct($product)
        );

    }

    /**
     * test parcel parser too large input
     */
    public function testParcelParserTooLargeInput(): void
    {
        $testSmall = new Specification(
            200,
            300,
            150,
            25,
            '$5.00',
            'Small'
        );
        $testMedium = new Specification(
            300,
            400,
            200,
            25,
            '$7.50',
            'Medium'
        );
        $testLarge = new Specification(
            400,
            600,
            250,
            25,
            '$8.50',
            'Large'
        );
        $parcelParser = new ParcelParser([$testLarge, $testSmall, $testMedium]);


        /**
         * test: too large number
         */
        $product = new Product(
            400,
            500,
            280,
            10
        );
        $this->assertEquals(
            false,
            $parcelParser->getSpecificationByProduct($product)
        );
    }

    /**
     * test parcel parser illegal input
     */
    public function testParcelParserIllegalInput(): void
    {
        $testSmall = new Specification(
            200,
            300,
            150,
            25,
            '$5.00',
            'Small'
        );
        $testMedium = new Specification(
            300,
            400,
            200,
            25,
            '$7.50',
            'Medium'
        );
        $testLarge = new Specification(
            400,
            600,
            250,
            25,
            '$8.50',
            'Large'
        );
        $parcelParser = new ParcelParser([$testLarge, $testSmall, $testMedium]);

        /**
         * test: illegal input, contains 0
         */
        try{
            $product = new Product(
                0,
                0,
                100,
                1
            );
            $this->assertEquals(
                false,
                $parcelParser->getSpecificationByProduct($product)
            );
        } catch (Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }

        /**
         * test: illegal input, contains negative number
         */
        try{
            $product = new Product(
                -22,
                0,
                100,
                10
            );
            $this->assertEquals(
                false,
                $parcelParser->getSpecificationByProduct($product)
            );
        } catch (Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }

        /**
         * test: illegal input, contains string
         */
        try{
            $product = new Product(
                200,
                'a',
                100,
                9
            );
            $this->assertEquals(
                false,
                $parcelParser->getSpecificationByProduct($product)
            );
        } catch (Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * test parcel parser append function
     */
    public function testParcelParserAppend(): void
    {
        $testSmall = new Specification(
            200,
            300,
            150,
            25,
            '$5.00',
            'Small'
        );
        $testMedium = new Specification(
            300,
            400,
            200,
            25,
            '$7.50',
            'Medium'
        );
        $testLarge = new Specification(
            400,
            600,
            250,
            25,
            '$8.50',
            'Large'
        );

        $parcelParser = new ParcelParser();
        $parcelParser->append([$testLarge, $testSmall, $testMedium]);

        $this->assertEquals(
            [$testSmall, $testMedium, $testLarge],
            $parcelParser->getSpecifications()
        );
    }

}
