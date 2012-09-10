<?php

namespace Emtags\Bundle\NewsletterBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use Emtags\Bundle\NewsletterBundle\Entity\Leads;
use Emtags\Bundle\NewsletterBundle\Entity\Dispatches;

class DispatchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('newsletter:dispatch')
            ->setDescription('Greet someone')
            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);

		$em = $this->getContainer()->get('doctrine')->getEntityManager();
		$entities = $em->createQueryBuilder()
			->select('leads')
			->from('EmtagsNewsletterBundle:Leads', 'leads')
			->innerJoin('leads.tag', 'tags')
			->Where('tags.name IN (:tags)')
			->andWhere('leads.enable = 1')
			->andWhere('leads.lastDispatch IS NULL')
			->setParameter('tags', array('Empresas','E-Mail'))
			->setMaxResults( 1 )
			->getQuery()
			->getResult();
			
        ##$entities = $em->getRepository('EmtagsNewsletterBundle:Leads')->findAll();
		// print_r($entities);exit;
		//$templating = $this->getContainer()->get('templating');//->render('ProgramBundle:Frontend:daily-email.html.twig');
		foreach ($entities as $entity) {
			echo "asdasd";
			$content = $this->getContainer()->get('templating')->render('EmtagsNewsletterBundle:Campaigns:emailpro.txt.twig');
			$output->writeln($entity->getEmail());
			$message = \Swift_Message::newInstance()
				->setSubject('Qual o seu e-mail profissional?')
				->setFrom('emtags@ig.com.br')
				->setTo($entity->getEmail())
				->setBody($content);
			$status = $this->getContainer()->get('mailer')->send($message);
			//$output->writeln($test);
			//print_r($this->getContainer()->get('templating'));
			$entity->setlastDispatch(new \DateTime('now'));
			$dispatch = new Dispatches();
			$campaign = $this->getContainer()->get('doctrine')->getRepository('EmtagsNewsletterBundle:Campaigns')->find(1);
			$dispatch = new Dispatches();
			$dispatch->setDate(new \DateTime('now'))
				->setCampaign($campaign)
				->setLead($entity);
			$em->persist($entity);
			$em->persist($dispatch);
			$em->flush();
		}
    }
}
