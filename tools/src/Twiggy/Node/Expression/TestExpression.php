<?php
declare(strict_types=1);

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LatteTools\Twiggy\Node\Expression;

use LatteTools\Twiggy\Compiler;
use LatteTools\Twiggy\Node\Node;

class TestExpression extends CallExpression
{
	public function __construct(Node $node, string $name, ?Node $arguments, int $lineno)
	{
		$nodes = ['node' => $node];
		if ($arguments !== null) {
			$nodes['arguments'] = $arguments;
		}

		parent::__construct($nodes, ['name' => $name], $lineno);
	}


	public function compile(Compiler $compiler): void
	{
		$name = $this->getAttribute('name');
		$test = $compiler->getEnvironment()->getTest($name);

		$this->setAttribute('name', $name);
		$this->setAttribute('type', 'test');
		$this->setAttribute('arguments', $test->getArguments());
		$this->setAttribute('callable', $test->getCallable());
		$this->setAttribute('is_variadic', $test->isVariadic());

		$this->compileCallable($compiler);
	}
}