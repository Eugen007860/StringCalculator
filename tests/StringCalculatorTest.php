<?php

namespace Deg540\PHPTestingBoilerplate;

use http\Exception;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\LinesOfCode\NegativeValueException;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturn1DigitNumber()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("4");

        $this->assertEquals(4, $result);
    }

    /**
     * @test
     */
    public function shouldReturn2DigitsNumber()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("10");

        $this->assertEquals(10, $result);
    }

    /**
     * @test
     */
    public function shouldReturn0()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("");

        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function shouldAddTwoNumber()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("12,33");

        $this->assertEquals(45, $result);
    }

    /**
     * @test
     */
    public function shouldAddMoreThanTwoNumber()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("4,6,3");

        $this->assertEquals(13, $result);
    }

    /**
     * @test
     */
    public function shouldAddTwoNumberWithLineBreak()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("2\n3");

        $this->assertEquals(5, $result);
    }

    /**
     * @test
     */
    public function shouldAddMoreThanTwoNumberWithLineBreak()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("2\n3,4,5\n6");

        $this->assertEquals(20, $result);
    }

    /**
     * @test
     */
    public function shouldAddNumberWithDelimiter()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//;\n1;2");

        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function shouldRecognizeDefaultDelimiter()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//\n1;2");

        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function shouldRefuseNegatives()
    {
        $this->expectException(NegativeValueException::class);

        $stringCalculator = new StringCalculator();

        $stringCalculator->add("-3,-4");
    }

    /**
     * @test
     */
    public function shouldIgnoreBiggerThan1000()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//;\n1001;2");

        $this->assertEquals(2, $result);
    }

    /**
     * @test
     */
    public function shouldRecognizeBiggerDelimiter()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//[]\n12***3");

        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function shouldRecognizeMoreDelimiters()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//[%][]\n12%3");

        $this->assertEquals(6, $result);
    }

}