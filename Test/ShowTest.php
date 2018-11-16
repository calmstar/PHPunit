<?php
// 下面加载的一般放在一个自动加载文件中
require '../vendor/autoload.php'; //加载 composer 依赖的所有包
require '../Src/Show.php'; // 加载要测试的 类
require '../Src/Weather.php'; // 加载要测试的 类

use PHPUnit\Framework\TestCase;
use services\Show;
use services\Weather;

class ShowTest extends TestCase
{
    public function testShowMoney ()
    {
        $show = new Show();
        $this->assertEquals(1, $show->showMoney());
    }

    public function testLogin ()
    {
        $loginYes = 1;
        $this->assertEquals(1, $loginYes);
        return $loginYes;
    }

    /**
     * @depends testLogin
     * @param $loginYes
     */
    public function testPost ($loginYes)
    {
        $this->assertEquals(true, $loginYes);
        return 5;
    }

    /**
     * @depends testPost
     * @param $amount
     */
    public function testActivity ($amount)
    {
        $this->assertGreaterThan(4, $amount);
    }

    /**
     * @dataProvider dataForSum
     */
    public function testSum ($n1, $n2)
    {
        $show = new Show();
        $this->assertEquals($n1+$n2, $show->sum($n1, $n2));
    }

    public function dataForSum ()
    {
        return [
            'one' => [1, 2],
            'two' => [3, 4],
            'three' => [1, -2],
            'four' => [11, 212],
        ];
    }

    // 异常测试
    public function testIntSum ()
    {
        $show = new Show();

        $this::assertEquals(4, $show->intSum(1, 2));
        $this->expectExceptionCode('666');
        $this->expectException(Exception::class);
        $show->intSum(1.1, 2);
    }

    public function testList ()
    {
        $this->assertEmpty(null);
        $this->assertEmpty(0);
        $this->assertTrue(true);
        $this->assertInternalType('integer', 1);
        $this->assertCount(2, [11,33]);
        $this->assertClassHasAttribute('aa', Show::class); // 类
        $this::assertObjectHasAttribute('aa', new Show()); // 对象

        $this::assertInstanceOf(show::class, new Show());
        $this->assertRegExp('/a$/', 'ssss2323a'); //以 a 结尾
    }




    public function testMard ()
    {
        $this->assertEquals(1,1);
        $this->markTestIncomplete('ha');
//        $this->markTestIncomplete('tt');
        $this->assertEquals(1,2);
    }

    public function testMock ()
    {
        // 创建替身，替身必须存在（类必须存在）
        $mockerWeather = $this->createMock(Weather::class);

        $mockerWeather->method('tomorrow')  // 定义要测试的方法，被模仿的方法必须存在于类中；
            ->with($this::equalTo('beijing'))  // 定义输入值
            ->willReturn('6-15');  // 定义该方法的返回值

        $this->assertEquals('6-15', $mockerWeather->tomorrow('beijing'));
//        $this->assertNotEquals('6-15', $mockerWeather->tomorrow('guangzhou')); 输入值只能是 beijing
    }

    public function testMock2 ()
    {
        $mockerWeather = $this->createMock(Weather::class);

        $mockerWeather->method('tomorrow')
            ->withConsecutive([$this::equalTo('beijing'),55], [$this::equalTo('guangzhou'), 66]) // 按顺序定义预期输入
            ->willReturnOnConsecutiveCalls('6-15', '5-10');  // 按顺序定义预期输出


        $this::assertEquals('6-15', $mockerWeather->tomorrow('beijing', 55));
        $this::assertEquals('5-10', $mockerWeather->tomorrow('guangzhou', 66));

    }

}



