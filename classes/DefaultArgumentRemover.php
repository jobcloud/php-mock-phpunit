<?php

namespace phpmock\phpunit;

use phpmock\generator\MockFunctionGenerator;
use PHPUnit\Framework\MockObject\Matcher\Invocation as MatcherInvocation;
use PHPUnit\Framework\MockObject\Invocation;

/**
 * Removes default arguments from the invocation.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license http://www.wtfpl.net/txt/copying/ WTFPL
 * @internal
 */
class DefaultArgumentRemover implements MatcherInvocation
{

    /**
     * @SuppressWarnings(PHPMD)
     * @param Invocation $invocation
     */
    public function invoked(Invocation $invocation)
    {
    }

    /**
     * @SuppressWarnings(PHPMD)
     * @param Invocation $invocation
     * @return bool
     */
    public function matches(Invocation $invocation)
    {
        $parameters = $invocation->getParameters();

        MockFunctionGenerator::removeDefaultArguments($parameters);

        $ref = new \ReflectionProperty(Invocation\StaticInvocation::class, 'parameters');
        $ref->setAccessible(true);
        $ref->setValue($invocation, $parameters);

        return false;
    }

    public function verify()
    {
    }
    
    /**
     * This method is not defined in the interface, but used in
     * PHPUnit_Framework_MockObject_InvocationMocker::hasMatchers().
     *
     * @return boolean
     * @see \PHPUnit_Framework_MockObject_InvocationMocker::hasMatchers()
     */
    public function hasMatchers()
    {
        return false;
    }

    public function toString(): string
    {
        return __CLASS__;
    }
}
