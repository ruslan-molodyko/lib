<?php

namespace SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use SystemBundle\Entity\Book;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadBookData implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {

        for ($i = 5; $i--;) {

            $book = new Book();

            $book->setTitle('������� �����');
            $book->setDescription('����� ���������� ������������ ����� �.����� ��������� ����, ��� ��� � �������� �� �����. �� �� ����������� "������� �����" ���������� �������������� ���� �������� ("��������� ����������"), ���������� "�������� ����" - ������ ������� ������������� ���������, ���� ������������ �����, �������� � ������ ������ �������� ������. ���� ����� � ��������� ������, ��� ������ � �������, ����������� ������ � ��������� ������ - ������� ����. �������, ����� �� ��� ������������ ������� ��������� �������� �������� ������, ���� ������ �� ��������, ��� ���������� �� ������� � ������������� ������� �����, ���������� � ������� �����. ������, ����� ������������ �� ���, ���� ��������� ��������� ������ ������� � ������� � ����� � ����� ������� ������, ��� ��� ������������. � ��� ����� ����� ����������� � �������� �������, ������� �������� ������, ���������� ����� �������, �������� ���������� � ������, ������ ������.');
            $book->setIsbn(90345345839);
            $book->setYear(new \DateTime('now'));
            $book->setImage('sdf');

            $manager->persist($book);
        }
        $manager->flush();
    }
}