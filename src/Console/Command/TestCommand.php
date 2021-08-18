<?php

namespace App\Console\Command;

use App\Aws\Discovery\Ec2Handler;
use App\Aws\Discovery\S3Handler;
use App\Aws\Model\Account;
use Aws\Ec2\Ec2Client;
use Aws\S3\S3Client;
use Ronanchilvers\Orm\Orm;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Test command
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class TestCommand extends Command
{
    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function configure()
    {
        $this
            ->setName('test')
            ->addArgument(
                'account',
                InputArgument::REQUIRED,
                'The account to query'
            )
            ;
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $accountId = $input->getArgument('account');
        $account = Orm::finder(Account::class)->one($accountId);
        if (!$account instanceof Account) {
            throw new \Exception('Invalid account id');
        }
        $regions = $account->regions;
        foreach ($regions as $region) {
            $output->writeln("Discovering EC2 resources in region {$region}... ");
            $client = new Ec2Client([
                'version' => 'latest',
                'region' => $region,
                'credentials' => $account->getCredentialsArray()
            ]);
            $ec2 = new Ec2Handler(
                $client,
                $account
            );
            $ec2->discover();

            $output->writeln("Discovering S3 resources in region {$region}... ");
            $client = new S3Client([
                'version' => 'latest',
                'region' => $region,
                'credentials' => $account->getCredentialsArray()
            ]);
            $s3 = new S3Handler(
                $client,
                $account
            );
            $s3->discover();
        }
        $output->writeln("Done");
    }
}
