<?php

use Headers\DisplayHeaders;
use Headers\Response\Cookie;
use Headers\Response\Expires;

class DisplayHeadersIntegrateTest extends PHPUnit\Framework\TestCase
{
    public function testDisplayHeadersShouldIntegrateWithCookieClass()
    {
        $cookie1 = new Cookie('name1', 'value123456');
        $cookie2 = new Cookie('name2', 'value678912332', new DateTimeImmutable('2023-02-06 13:00:00'));
        
        $expires = new Expires();
        $cookie2->setExpires($expires->days(0)->months(0)->years(0)->hours(2)->minutes(20)->seconds(38));

        $displayHeaders = new DisplayHeaders();
        $displayHeaders->add($cookie1);
        $displayHeaders->add($cookie2);

        $result = $displayHeaders->getHeaderString();

        $this->assertEquals(<<<HEADERS
            Set-Cookie: name1=value123456
            Set-Cookie: name2=value678912332; Expires=Mon, 06 Feb 2023 15:20:38 GMT
            HEADERS, $result
        );
    }

    public function testDisplayHeadersShouldIntegrateWithCookieClassWithExpires()
    {
        $cookie1 = new Cookie('name1', 'value123456', new DateTimeImmutable('2023-02-06 13:00:00'));

        $expires1 = new Expires();
        $expires2 = new Expires();

        $cookie1->setExpires($expires1->days(1)->months(0)->years(0)->hours(2)->minutes(42)->seconds(29));

        $cookie2 = new Cookie('name2', 'value678912332', new DateTimeImmutable('2023-02-06 13:00:00'));
        $cookie2->setExpires($expires2->days(0)->months(0)->years(0)->hours(2)->minutes(20)->seconds(38));

        $displayHeaders = new DisplayHeaders();
        $displayHeaders->add($cookie1);
        $displayHeaders->add($cookie2);

        $result = $displayHeaders->getHeaderString();

        $this->assertEquals(<<<HEADERS
            Set-Cookie: name1=value123456; Expires=Tue, 07 Feb 2023 15:42:29 GMT
            Set-Cookie: name2=value678912332; Expires=Mon, 06 Feb 2023 15:20:38 GMT
            HEADERS, $result
        );
    }

    public function testDisplayHeadersShouldIntegrateWith3CookieClassWithExpires()
    {
        $expires1 = new Expires();
        $expires2 = new Expires();
        $expires3 = new Expires();

        $cookie1 = new Cookie('name1', 'value123456', new DateTimeImmutable('2023-02-06 13:00:00'));
        $cookie1->setExpires($expires1->days(1)->months(0)->years(0)->hours(2)->minutes(42)->seconds(29));

        $cookie2 = new Cookie('name2', 'value678912332', new DateTimeImmutable('2023-02-06 13:00:00'));
        $cookie2->setExpires($expires2->days(0)->months(0)->years(0)->hours(2)->minutes(20)->seconds(38));

        $cookie3 = new Cookie('name3', 'valueqwee12334', new DateTimeImmutable('2023-02-06 13:00:00'));
        $cookie3->setExpires($expires3->days(0)->months(0)->years(0)->hours(1)->minutes(30)->seconds(22));

        $displayHeaders = new DisplayHeaders();
        $displayHeaders->add($cookie1);
        $displayHeaders->add($cookie2);
        $displayHeaders->add($cookie3);

        $result = $displayHeaders->getHeaderString();

        $this->assertEquals(<<<HEADERS
            Set-Cookie: name1=value123456; Expires=Tue, 07 Feb 2023 15:42:29 GMT
            Set-Cookie: name2=value678912332; Expires=Mon, 06 Feb 2023 15:20:38 GMT
            Set-Cookie: name3=valueqwee12334; Expires=Mon, 06 Feb 2023 14:30:22 GMT
            HEADERS, $result
        );
    }

    public function testDisplayHeadersWithoutHeadersShouldThrowAnException()
    {
        $this->expectException(\Exception::class);
        $this->getExpectedExceptionMessage('There is no headers to display');
        
        $displayHeaders = new DisplayHeaders();
        $displayHeaders->getHeaderString();
    }
}