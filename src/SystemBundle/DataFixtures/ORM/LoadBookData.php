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

            $book->setTitle('Ходячий замок');
            $book->setDescription('Книги английской писательницы Дианы У.Джонс настолько ярки, что так и просятся на экран. По ее бестселлеру "Ходячий замок" знаменитый мультипликатор Хаяо Миядзаки ("Унесенные призраками"), обладатель "Золотого льва" - высшей награды Венецианского фестиваля, снял анимационный фильм, побивший в Японии рекорд кассовых сборов. Софи живет в сказочной стране, где ведьмы и русалки, семимильные сапоги и говорящие собаки - обычное дело. Поэтому, когда на нее обрушивается ужасное проклятие коварной Болотной Ведьмы, Софи ничего не остается, как обратиться за помощью к таинственному чародею Хоулу, обитающему в Ходячем замке. Однако, чтобы освободиться от чар, Софи предстоит разгадать немало загадок и прожить в замке у Хоула гораздо дольше, чем она рассчитывала. А для этого нужно подружиться с огненным демоном, поймать падающую звезду, подслушать пение русалок, отыскать мандрагору и многое, многое другое.');
            $book->setIsbn(90345345839);
            $book->setYear(new \DateTime('now'));
            $book->setImage('sdf');

            $manager->persist($book);
        }
        $manager->flush();
    }
}