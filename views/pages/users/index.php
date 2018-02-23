<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Registration - Waiting', 'lms-plugin'); ?>
    </h1>

<!--    <a href="http://fishy-minds.test/wp-admin/user-new.php" class="page-title-action">Add New</a>-->

    <hr class="wp-header-end">

    <?php $table->views(); ?>

    <h2 class="screen-reader-text">Filter users list</h2><ul class="subsubsub">
        <li class="all"><a href="users.php" class="current" aria-current="page">All <span class="count">(6)</span></a> |</li>
        <li class="administrator"><a href="users.php?role=administrator">Administrator <span class="count">(1)</span></a> |</li>
        <li class="subscriber"><a href="users.php?role=subscriber">Subscriber <span class="count">(2)</span></a> |</li>
        <li class="backoffice"><a href="users.php?role=backoffice">Backoffice <span class="count">(1)</span></a> |</li>
        <li class="technicians"><a href="users.php?role=technicians">Technicians <span class="count">(1)</span></a> |</li>
        <li class="sales"><a href="users.php?role=sales">Sales <span class="count">(1)</span></a></li>
    </ul>
    <form method="get">

        <p class="search-box">
            <label class="screen-reader-text" for="user-search-input">Search Users:</label>
            <input type="search" id="user-search-input" name="s" value="">
            <input type="submit" id="search-submit" class="button" value="Search Users"></p>


        <input type="hidden" id="_wpnonce" name="_wpnonce" value="4fd804b008"><input type="hidden" name="_wp_http_referer" value="/wp-admin/users.php">	<div class="tablenav top">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label><select name="action" id="bulk-action-selector-top">
                    <option value="-1">Bulk Actions</option>
                    <option value="delete">Delete</option>
                </select>
                <input type="submit" id="doaction" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
                <label class="screen-reader-text" for="new_role">Change role to…</label>
                <select name="new_role" id="new_role">
                    <option value="">Change role to…</option>

                    <option value="sales">Sales</option>
                    <option value="technicians">Technicians</option>
                    <option value="backoffice">Backoffice</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="contributor">Contributor</option>
                    <option value="author">Author</option>
                    <option value="editor">Editor</option>
                    <option value="administrator">Administrator</option>		</select>
                <input type="submit" name="changeit" id="changeit" class="button" value="Change">		</div>
            <div class="tablenav-pages one-page"><span class="displaying-num">6 items</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>
        <h2 class="screen-reader-text">Users list</h2><table class="wp-list-table widefat fixed striped users">
            <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td><th scope="col" id="username" class="manage-column column-username column-primary sortable desc"><a href="http://fishy-minds.test/wp-admin/users.php?orderby=login&amp;order=asc"><span>Username</span><span class="sorting-indicator"></span></a></th><th scope="col" id="name" class="manage-column column-name">Name</th><th scope="col" id="email" class="manage-column column-email sortable desc"><a href="http://fishy-minds.test/wp-admin/users.php?orderby=email&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a></th><th scope="col" id="role" class="manage-column column-role">Role</th><th scope="col" id="posts" class="manage-column column-posts num">Posts</th>	</tr>
            </thead>

            <tbody id="the-list" data-wp-lists="list:user" _vimium-has-onclick-listener="">

            <tr id="user-1"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_1">Select admin</label><input type="checkbox" name="users[]" id="user_1" class="administrator" value="1"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://0.gravatar.com/avatar/628ae600c01353c98e2abb0ebbceac08?s=32&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/628ae600c01353c98e2abb0ebbceac08?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">admin</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="view"><a href="http://fishy-minds.test/author/admin/" aria-label="View posts by admin">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">Dmytro Sergiienko</td><td class="email column-email" data-colname="Email"><a href="mailto:dmytro.sergiienko@beetroot.se">dmytro.sergiienko@beetroot.se</a></td><td class="role column-role" data-colname="Role">Administrator</td><td class="posts column-posts num" data-colname="Posts"><a href="edit.php?author=1" class="edit"><span aria-hidden="true">1</span><span class="screen-reader-text">1 post by this author</span></a></td></tr>
            <tr id="user-4"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_4">Select Froppire</label><input type="checkbox" name="users[]" id="user_4" class="backoffice" value="4"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://0.gravatar.com/avatar/cec221ba8d6995d6de0eede5f8ad7c96?s=32&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/cec221ba8d6995d6de0eede5f8ad7c96?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=4&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Froppire</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=4&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="delete"><a class="submitdelete" href="users.php?action=delete&amp;user=4&amp;_wpnonce=4fd804b008">Delete</a> | </span><span class="view"><a href="http://fishy-minds.test/author/froppire/" aria-label="View posts by Robert Lang">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">Robert Lang</td><td class="email column-email" data-colname="Email"><a href="mailto:RobertDLang@dayrep.com">RobertDLang@dayrep.com</a></td><td class="role column-role" data-colname="Role">Backoffice</td><td class="posts column-posts num" data-colname="Posts">0</td></tr>
            <tr id="user-3"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_3">Select JaneDoe</label><input type="checkbox" name="users[]" id="user_3" class="sales" value="3"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://0.gravatar.com/avatar/35f5782642e9fa0f6cfff5a552e2ae97?s=32&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/35f5782642e9fa0f6cfff5a552e2ae97?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=3&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">JaneDoe</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=3&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="delete"><a class="submitdelete" href="users.php?action=delete&amp;user=3&amp;_wpnonce=4fd804b008">Delete</a> | </span><span class="view"><a href="http://fishy-minds.test/author/janedoe/" aria-label="View posts by Jane Doe">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">Jane Doe</td><td class="email column-email" data-colname="Email"><a href="mailto:jane@doe.com">jane@doe.com</a></td><td class="role column-role" data-colname="Role">Sales</td><td class="posts column-posts num" data-colname="Posts">0</td></tr>
            <tr id="user-2"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_2">Select JohnDoe</label><input type="checkbox" name="users[]" id="user_2" class="technicians" value="2"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://0.gravatar.com/avatar/6a6c19fea4a3676970167ce51f39e6ee?s=32&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/6a6c19fea4a3676970167ce51f39e6ee?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=2&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">JohnDoe</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=2&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="delete"><a class="submitdelete" href="users.php?action=delete&amp;user=2&amp;_wpnonce=4fd804b008">Delete</a> | </span><span class="view"><a href="http://fishy-minds.test/author/johndoe/" aria-label="View posts by John Doe">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">John Doe</td><td class="email column-email" data-colname="Email"><a href="mailto:john@doe.com">john@doe.com</a></td><td class="role column-role" data-colname="Role">Technicians</td><td class="posts column-posts num" data-colname="Posts">0</td></tr>
            <tr id="user-6"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_6">Select MarkoWinkel@jourrapide.com</label><input type="checkbox" name="users[]" id="user_6" class="subscriber" value="6"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://0.gravatar.com/avatar/64f129a0aabd46004b234cbf28e6b98c?s=32&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/64f129a0aabd46004b234cbf28e6b98c?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=6&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">MarkoWinkel@jourrapide.com</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=6&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="delete"><a class="submitdelete" href="users.php?action=delete&amp;user=6&amp;_wpnonce=4fd804b008">Delete</a> | </span><span class="view"><a href="http://fishy-minds.test/author/markowinkeljourrapide-com/" aria-label="View posts by Marko Winkel">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">Marko Winkel</td><td class="email column-email" data-colname="Email"><a href="mailto:MarkoWinkel@jourrapide.com">MarkoWinkel@jourrapide.com</a></td><td class="role column-role" data-colname="Role">Subscriber</td><td class="posts column-posts num" data-colname="Posts">0</td></tr>
            <tr id="user-5"><th scope="row" class="check-column"><label class="screen-reader-text" for="user_5">Select TorstenKluge@armyspy.com</label><input type="checkbox" name="users[]" id="user_5" class="subscriber" value="5"></th><td class="username column-username has-row-actions column-primary" data-colname="Username"><img alt="" src="http://2.gravatar.com/avatar/5f416b8b89a739f075e3aa95c5dd659c?s=32&amp;d=mm&amp;r=g" srcset="http://2.gravatar.com/avatar/5f416b8b89a739f075e3aa95c5dd659c?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32"> <strong><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=5&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">TorstenKluge@armyspy.com</a></strong><br><div class="row-actions"><span class="edit"><a href="http://fishy-minds.test/wp-admin/user-edit.php?user_id=5&amp;wp_http_referer=%2Fwp-admin%2Fusers.php">Edit</a> | </span><span class="delete"><a class="submitdelete" href="users.php?action=delete&amp;user=5&amp;_wpnonce=4fd804b008">Delete</a> | </span><span class="view"><a href="http://fishy-minds.test/author/torstenklugearmyspy-com/" aria-label="View posts by Torsten Kluge">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="name column-name" data-colname="Name">Torsten Kluge</td><td class="email column-email" data-colname="Email"><a href="mailto:TorstenKluge@armyspy.com">TorstenKluge@armyspy.com</a></td><td class="role column-role" data-colname="Role">Subscriber</td><td class="posts column-posts num" data-colname="Posts">0</td></tr>	</tbody>

            <tfoot>
            <tr>
                <td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></td><th scope="col" class="manage-column column-username column-primary sortable desc"><a href="http://fishy-minds.test/wp-admin/users.php?orderby=login&amp;order=asc"><span>Username</span><span class="sorting-indicator"></span></a></th><th scope="col" class="manage-column column-name">Name</th><th scope="col" class="manage-column column-email sortable desc"><a href="http://fishy-minds.test/wp-admin/users.php?orderby=email&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a></th><th scope="col" class="manage-column column-role">Role</th><th scope="col" class="manage-column column-posts num">Posts</th>	</tr>
            </tfoot>

        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="action2" id="bulk-action-selector-bottom">
                    <option value="-1">Bulk Actions</option>
                    <option value="delete">Delete</option>
                </select>
                <input type="submit" id="doaction2" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
                <label class="screen-reader-text" for="new_role2">Change role to…</label>
                <select name="new_role2" id="new_role2">
                    <option value="">Change role to…</option>

                    <option value="sales">Sales</option>
                    <option value="technicians">Technicians</option>
                    <option value="backoffice">Backoffice</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="contributor">Contributor</option>
                    <option value="author">Author</option>
                    <option value="editor">Editor</option>
                    <option value="administrator">Administrator</option>		</select>
                <input type="submit" name="changeit2" id="changeit2" class="button" value="Change">		</div>
            <div class="tablenav-pages one-page"><span class="displaying-num">6 items</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>
    </form>

    <br class="clear">
</div>