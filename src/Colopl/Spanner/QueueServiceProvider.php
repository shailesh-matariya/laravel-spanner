<?php

namespace Colopl\Spanner;

use Colopl\Spanner\Queue\Connectors\SpannerConnector;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Queue\Failed\DatabaseFailedJobProvider;
use Illuminate\Queue\QueueServiceProvider as LaravelQueueServiceProvider;

class QueueServiceProvider extends LaravelQueueServiceProvider implements DeferrableProvider
{
    /**
     * Register the connectors on the queue manager.
     *
     * @param  \Illuminate\Queue\QueueManager  $manager
     * @return void
     */
    public function registerConnectors($manager)
    {
        foreach (['Null', 'Sync', 'Database', 'Redis', 'Beanstalkd', 'Sqs', 'Spanner'] as $connector) {
            $this->{"register{$connector}Connector"}($manager);
        }
    }

    /**
     * Register the Spanner queue connector.
     *
     * @param  \Illuminate\Queue\QueueManager  $manager
     * @return void
     */
    protected function registerSpannerConnector($manager)
    {
        $manager->addConnector('spanner', function () {
            return new SpannerConnector($this->app['db']);
        });
    }

    /**
     * @TODO convert to spanner
     * Create a new database failed job provider.
     *
     * @param  array  $config
     * @return \Illuminate\Queue\Failed\DatabaseFailedJobProvider
     */
    protected function databaseFailedJobProvider($config)
    {
        return new DatabaseFailedJobProvider(
            $this->app['db'], $config['database'], $config['table']
        );
    }
}
