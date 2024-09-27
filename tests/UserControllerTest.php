<?php

use App\model\Users;

require_once __DIR__ . '/../App/model/Users.php';
require_once __DIR__ . '/../Database.php';

class UserControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testUserRegistrationSuccess()
    {
        $userMock = $this->createMock(Users::class);

        $userMock->method('register')
            ->willReturn("Register Success");

        $controller = new Users($userMock);
        $result = $controller->register("Sajit", "pata@gmail.com", "Sajit@123", "user");

        $this->assertEquals("Register Success", $result);
    }
}
