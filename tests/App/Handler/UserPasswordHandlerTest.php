<?php

namespace App\Handler;

use App\Entity\User;
use App\Repository\RequestPasswordRepository;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserPasswordHandlerTest extends TestCase
{
    public function testSendEmailForChoose()
    {
        $mailerMock = $this->createMock(MailerInterface::class);
        $userPasswordHandler = new UserPasswordHandler(
            $this->createMock(UserPasswordHasherInterface::class),
            $this->createMock(TranslatorInterface::class),
            $mailerMock,
            $this->createMock(RequestPasswordRepository::class),
            $this->createMock(UserRepository::class),
            'test@test.fr'
        );

        $mailerMock->expects($this->once())
            ->method('send');

        $userPasswordHandler->sendEmailForChoose(
            (new User())
                ->setEmail('testeur@test.fr')
        );
    }
}
