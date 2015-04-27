<?php
 /**
 * Part of the Laradic packages.
 * MIT License and copyright information bundled with this package in the LICENSE file.
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
use Illuminate\Database\Seeder;
use Laradic\Support\String;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class StubSeeder
 *
 * @package     ${NAMESPACE}
 */
class AdminSeeder extends Seeder
{
    public function run()
    {
        app('files')->requireOnce(base_path('vendor/rydurham/sentinel/src/seeds/DatabaseSeeder.php'));
        $this->call('SentinelDatabaseSeeder');
        VarDumper::dump('AdminSeeder->run()');
    }
}
