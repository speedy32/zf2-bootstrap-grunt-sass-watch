<?php
function testUnclosedDoubleQuoteStringResultsInExpectedException() {
    $x = ';
}