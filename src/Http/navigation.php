<?php

Navigation::add('admin', 'Admin menu', null, '#', true, ['admin']);
Navigation::add('admin.dashboard', 'Dashboard', 'admin', 'home');


Navigation::add('admin-right', 'Admin user menu', null);
Navigation::add('admin-right.users', '<i class="fa fa-users"></i>', 'admin-right', null);
Navigation::add('admin-right.users.logout', '<i class="fa fa-key"></i> Logout', 'admin-right.users', 'sentinel.logout', true);

