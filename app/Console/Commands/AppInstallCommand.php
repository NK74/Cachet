<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * This is the app install command.
 *
 * @author James Brooks <james@alt-three.com>
 */
class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the application';

    /**
     * The events instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->events->fire('command.installing', $this);
        $this->events->fire('command.generatekey', $this);
        $this->events->fire('command.cacheconfig', $this);
        $this->events->fire('command.cacheroutes', $this);
        $this->events->fire('command.publishvendors', $this);
        $this->events->fire('command.runmigrations', $this);
        $this->events->fire('command.runseeding', $this);
        $this->events->fire('command.updatecache', $this);
        $this->events->fire('command.linkstorage', $this);
        $this->events->fire('command.extrastuff', $this);
        $this->events->fire('command.installed', $this);
    }
}
