<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepositoryTest extends TestCase
{
    public function testUserRepositoryIsMappedToUserEntity()
    {
        $mockEntityManager = $this->createMock(EntityManagerInterface::class);
        $mockEntityManager->expects($this->once())
            ->method('getClassMetadata')
            ->with(User::class)
            ->willReturn(new ClassMetadata(User::class));

        $mockRegistry = $this->createMock(RegistryInterface::class);
        $mockRegistry->expects($this->once())
            ->method('getManagerForClass')
            ->with(User::class)
            ->willReturn($mockEntityManager);

        /** @var RegistryInterface $mockRegistry */
        new UserRepository($mockRegistry);
    }
}
