<?php
/**
 * Copyright 2019 Martin Meredith <martin@sourceguru.net>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace Mez\DoctrineBehaviors\ORM\Timestampable;

use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\ORM\Timestampable\TimestampableSubscriber;
use Knp\DoctrineBehaviors\Reflection\ClassAnalyzer;
use Psr\Container\ContainerInterface;

/**
 * Class TimestampableSubscriberFactory
 *
 * @package Mez\DoctrineBehaviors\ORM\Timestampable
 */
final class TimestampableSubscriberFactory
{
    /**
     * __invoke
     *
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Knp\DoctrineBehaviors\ORM\Timestampable\TimestampableSubscriber
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var array $config */
        $config = $container->get('config')['doctrine-behaviors'];

        /** @var ClassAnalyzer $classAnalyzer */
        $classAnalyzer = $container->get(ClassAnalyzer::class);

        return new TimestampableSubscriber(
            $classAnalyzer,
            $config['reflection']['is_recursive'],
            Timestampable::class,
            $config['timestampable_subscriber']['db_field_type']
        );
    }
}
