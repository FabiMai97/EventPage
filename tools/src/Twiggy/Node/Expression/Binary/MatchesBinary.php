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

namespace LatteTools\Twiggy\Node\Expression\Binary;

use LatteTools\Twiggy\Compiler;

class MatchesBinary extends AbstractBinary
{
	public function compile(Compiler $compiler): void
	{
		$compiler
			->raw('preg_match(')
			->subcompile($this->getNode('right'))
			->raw(', ')
			->subcompile($this->getNode('left'))
			->raw(')')
		;
	}


	public function operator(Compiler $compiler): Compiler
	{
		return $compiler->raw('');
	}
}