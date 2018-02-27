<?php

namespace LmsPlugin;

use FishyMinds\Request;

class UsersListTable
{
    private $request;

    public function __construct(Request $request, $args = [])
    {
        $this->request = $request;
    }

    /**
	 * Get an associative array ( id => link ) with the list
	 * of views available on this table.
	 *
	 * @since 3.1.0
	 *
	 * @return array
	 */
	protected function get_views() {
        $views = [
            'all' => [
                'label' => 'All',
                'link' => 'users.php?page=users'
            ],
            'admin' => [
                'label' => 'Admin',
                'link' => 'users.php?page=users&filter=admin'
            ],
            'waiting' => [
                'label' => 'Waiting',
                'link' => 'users.php?page=users&filter=waiting'
            ],
            'invited' => [
                'label' => 'Invited',
                'link' => 'users.php?page=users&filter=invited'
            ],
            'suspended' => [
                'label' => 'Suspended',
                'link' => 'users.php?page=users&filter=suspended'
            ]
        ];
        $result = [];
        $link_template = '<a href="%s"%s>%s <span class="count">(%d)</span></a>';

        foreach ($views as $name => $view) {
            $attributes = $this->request->get('filter', 'all') == $name ? ' class="current" aria-current="page"' : '';
            $result[$name] = sprintf(
                $link_template,
                $view['link'],
                $attributes,
                $view['label'],
                0
            );
        }

        return $result;
	}

    /**
     * Get a list of columns for the list table.
     *
     * @since  3.1.0
     *
     * @return array Array in which the key is the ID of the column,
     *               and the value is the description.
     */
	public function get_columns()
    {
        return [
            'cb'       => '<input type="checkbox">',
			'name'     => __( 'Name' ),
			'email'    => __( 'Email' ),
            'role'     => __( 'Role' ),
            'activity' => __( 'Last Activity' ),
            'status'   => __( 'Status' )
        ];
    }

    /**
     * Output 'no users' message.
     *
     * @since 3.1.0
     */
    public function no_items()
    {
        _e( 'No users found.' );
    }

    /**
     * Prepares the list of items for displaying.
     * @uses WP_List_Table::set_pagination_args()
     *
     * @since 3.1.0
     * @abstract
     */
    public function prepare_items()
    {
        $args = [
            'fields' => 'all_with_meta'
        ];

        $users_per_page = $this->get_items_per_page('users_per_page');

        // Query the user IDs for this page
        $users = new \WP_User_Query($args);

        $this->items = $users->get_results();

        $this->set_pagination_args([
            'total_items' => $users->get_total(),
            'per_page' => $users_per_page,
        ]);

        $this->_column_headers = [
            $this->get_columns(),		    // columns
            [],			                    // hidden
            $this->get_sortable_columns(),	// sortable
        ];
    }
}