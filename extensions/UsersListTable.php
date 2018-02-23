<?php

namespace LmsPlugin;

class UsersListTable extends \WP_List_Table
{
    /**
	 * Get an associative array ( id => link ) with the list
	 * of views available on this table.
	 *
	 * @since 3.1.0
	 *
	 * @return array
	 */
	protected function get_views() {
		return [
		    'all' => 'All',
            'admin' => 'Admin',
            'waiting' => 'Waiting',
            'invited' => 'Invited',
            'suspended' => 'Suspended'
        ];
	}
}