<?php

namespace Deg540\PHPTestingBoilerplate;

use SebastianBergmann\LinesOfCode\NegativeValueException;

class StringCalculator
{
    function add(string $number): int
    {
        if (empty($number)) {
            return 0;
        }

        else {

            if (str_contains($number, "//")) {
                $number = explode("//", $number, 2)[1];
                if (str_contains($number, "[") and str_contains($number, "]")) {
                    $delimiters = explode("\n",$number,2)[0];
                    $delimiter = ";";
                    $delimiters = explode("]", $delimiters, PHP_INT_MAX);
                    foreach( $delimiters as $valor){
                        if ($valor === "["){
                            $delimiter = "empty";
                        }
                        else{
                            $aux = explode("[", $valor, 2);
                            $number = str_replace($aux, ";", $number);
                        }
                    }
                }
                else {
                    $delimiter = explode("\n", $number, 2)[0];
                    if (empty($delimiter)){
                        $delimiter = ";";
                    }
                }
                $number = explode("\n", $number, 2)[1];
            }

            else {
                $delimiter = ",";
            }

            if ($delimiter === "empty" or str_contains($number, $delimiter) or str_contains($number, "\n")) {
                $number = str_replace("\n", $delimiter, $number);
                $numbers = explode($delimiter, $number);
                $result = 0;
                $negatives = array();
                foreach ($numbers as $value) {

                    if ((int)$value <0) {
                        $negatives[] = $value;
                    }

                    else if ( (int)$value and (int)$value<1001) {
                        if ($delimiter === "empty") {
                            $result = $result + array_sum(str_split($value));
                        }
                        else {
                            $result = $result + (int)$value;
                        }
                    }
                }

                if (empty($negatives)) {
                    return $result;
                }

                else{
                    throw new NegativeValueException('Negativos no soportados');
                }
            }

            return (int)$number;
        }
    }
}