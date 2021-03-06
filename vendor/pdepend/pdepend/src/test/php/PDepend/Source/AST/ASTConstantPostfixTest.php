<?php
/**
 * This file is part of PDepend.
 *
 * PHP Version 5
 *
 * Copyright (c) 2008-2013, Manuel Pichler <mapi@pdepend.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2008-2013 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace PDepend\Source\AST;

/**
 * Test case for the {@link \PDepend\Source\AST\ASTConstantPostfix} class.
 *
 * @copyright 2008-2013 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 *
 * @covers \PDepend\Source\Language\PHP\AbstractPHPParser
 * @covers \PDepend\Source\AST\ASTConstantPostfix
 * @group unittest
 */
class ASTConstantPostfixTest extends \PDepend\Source\AST\ASTNodeTest
{
    /**
     * Tests that a parsed constant postfix has the expected object structure.
     *
     * @return void
     */
    public function testConstantPostfixStructureForSimpleStaticAccess()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertEquals('BAZ', $postfix->getImage());
    }

    /**
     * Tests that a parsed method postfix has the expected object structure.
     *
     * @return void
     */
    public function testConstantPostfixStructureForStaticAccessOnVariable()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertInstanceOf('PDepend\\Source\\AST\\ASTIdentifier', $postfix->getChild(0));
    }

    /**
     * testConstantPostfixHasExpectedStartLine
     *
     * @return void
     */
    public function testConstantPostfixHasExpectedStartLine()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertEquals(4, $postfix->getStartLine());
    }

    /**
     * testConstantPostfixHasExpectedStartColumn
     *
     * @return void
     */
    public function testConstantPostfixHasExpectedStartColumn()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertEquals(11, $postfix->getStartColumn());
    }

    /**
     * testConstantPostfixHasExpectedEndLine
     *
     * @return void
     */
    public function testConstantPostfixHasExpectedEndLine()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertEquals(4, $postfix->getEndLine());
    }

    /**
     * testConstantPostfixHasExpectedEndColumn
     *
     * @return void
     */
    public function testConstantPostfixHasExpectedEndColumn()
    {
        $postfix = $this->_getFirstConstantPostfixInFunction(__METHOD__);
        $this->assertEquals(13, $postfix->getEndColumn());
    }

    /**
     * Returns a node instance for the currently executed test case.
     *
     * @param string $testCase Name of the calling test case.
     *
     * @return \PDepend\Source\AST\ASTConstantPostfix
     */
    private function _getFirstConstantPostfixInFunction($testCase)
    {
        return $this->getFirstNodeOfTypeInFunction(
            $testCase,
            'PDepend\\Source\\AST\\ASTConstantPostfix'
        );
    }
}
