<?php
namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
class TaxrefFixtures extends AbstractFixture implements ContainerAwareInterface,OrderedFixtureInterface
{

    private $container;
    /**
     * Sets the container.
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        set_time_limit(0);
        // Bundle to manage file and directories
        $finder = new Finder();
        $finder->in('sql');
        $finder->name('taxref.sql');
        foreach( $finder as $file ){
            $content = $file->getContents();
            $stmt = $this->container->get('doctrine.orm.entity_manager')->getConnection()->prepare($content);
            $stmt->execute();
        }
    }
    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }
}