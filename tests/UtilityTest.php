<?php
use PHPUnit\Framework\TestCase;

class UtilityTest extends TestCase {
    /**
     * @runInSeparateProcess
     */
    public function test_get_min_suffix_returns_min_by_default() {
        $this->assertSame('.min', atlantic_get_min_suffix());
    }

    /**
     * @runInSeparateProcess
     */
    public function test_get_min_suffix_returns_empty_when_debug() {
        define('SCRIPT_DEBUG', true);
        $this->assertSame('', atlantic_get_min_suffix());
    }
}
