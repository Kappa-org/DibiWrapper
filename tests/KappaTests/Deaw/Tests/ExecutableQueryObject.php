<?php
/**
 * This file is part of the Kappa\Deaw package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace KappaTests\Deaw\Tests;

use Kappa\Deaw\Queries\QueryBuilder;
use Kappa\Deaw\Queries\QueryObject;

/**
 * Class ExecutableQueryObject
 * @package KappaTests\Deaw\Tests
 */
class ExecutableQueryObject extends QueryObject
{
	/**
	 * @param QueryBuilder $builder
	 * @return \Dibi\Fluent
	 */
	public function getQuery(QueryBuilder $builder)
	{
		$query = $builder->createQuery()->insert(['name' => 'bar']);

		return $query;
	}
}