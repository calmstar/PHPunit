<?php
/**
 * Created by PhpStorm.
 * User: MGZ2018072718B
 * Date: 2018/11/12
 * Time: 14:23
 *
 * 笔记：
 *
 * 针对类 Class 的测试写在类 ``ClassTest``中。
    ClassTest``（通常）继承自 ``PHPUnit\Framework\TestCase。
    测试都是命名为 test* 的公用方法。
    也可以在方法的文档注释块(docblock)中使用 @test 标注将其标记为测试方法。
    在测试方法内，类似于 ``assertEquals()``（参见 appendixes.assertions）这样的断言方法用来对实际值与预期值的匹配做出断言。
 *
 */

namespace Test;

use PHPUnit\Framework\TestCase;


class StackTest extends TestCase
{
    /**
     * @test
     */
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }


    /**
     * 以下三个为依赖关系
     * @return array
     */
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack)
    {
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
     * @depends testPush
     * $stack 参数会依赖于 testPush 方法返回的变量
     */
    public function testPop(array $stack)
    {
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }

    // 测试依赖，以下两个
    public function testOne()
    {
        $this->assertTrue(false);
    }

    /**
     * @depends testOne
     */
    public function testTwo()
    {
    }


}