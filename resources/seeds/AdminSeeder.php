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
        $f = app('files');
        $file = 'vendor/rydurham/sentinel/src/seeds/DatabaseSeeder.php';
        $require = base_path($file);
        if($f->exists(__DIR__ . '/../../' . $file))
        {
            $require = __DIR__ . '/../../' . $file;
        }
        app('files')->requireOnce($require);

        $this->call('SentinelDatabaseSeeder');
        VarDumper::dump('AdminSeeder->run()');
    }
}
