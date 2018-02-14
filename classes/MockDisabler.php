<?php

namespace phpmock\phpunit;

use phpmock\Deactivatable;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;

/**
 * Test listener for PHPUnit integration.
 *
 * This class disables mock functions after a test was run.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license http://www.wtfpl.net/txt/copying/ WTFPL
 * @internal
 */
class MockDisabler implements TestListener
{
    use TestListenerDefaultImplementation;

    /**
     * @var Deactivatable The function mocks.
     */
    private $deactivatable;
    
    /**
     * Sets the function mocks.
     *
     * @param Deactivatable $deactivatable The function mocks.
     */
    public function __construct(Deactivatable $deactivatable)
    {
        $this->deactivatable = $deactivatable;
    }
    
    /**
     * Disables the function mocks.
     *
     * @param Test  $test The test.
     * @param float $time The test duration.
     *
     * @see Mock::disable()
     */
    public function endTest(Test $test, float $time): void
    {
        $this->deactivatable->disable();
    }
}
