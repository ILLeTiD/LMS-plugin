<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Participants', 'lms-plugin'); ?>

        <?php if ($course): ?>
            : <?= $course->post_title; ?>
        <?php endif; ?>
    </h1>

    <?php if ($course): ?>
        <a href="#TB_inline?width=auto&height=500&inlineId=lms-invite-participants"
           class="page-title-action thickbox js-invite-popup-button"
        >
            <?= __('Invite', 'lms-plugin'); ?>
        </a>

        <?php include 'invite.php'; ?>

        <?php if (array_key_exists('invited', $_GET)): ?>
            <div id="message" class="updated notice notice-success is-dismissible">
                <p><?= __('Participants have been invited.', 'lms-plugin'); ?></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text"><?= __('Dismiss this notice.'); ?></span>
                </button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <hr class="wp-header-end">


    <h2 class="screen-reader-text">Filter posts list</h2><ul class="subsubsub">
        <li class="all"><a href="edit.php?post_type=course" class="current" aria-current="page">All <span class="count">(1)</span></a> |</li>
        <li class="publish"><a href="edit.php?post_status=publish&amp;post_type=course">Published <span class="count">(1)</span></a></li>
    </ul>
    <form id="posts-filter" method="get">

        <p class="search-box">
            <label class="screen-reader-text" for="post-search-input">Search Courses:</label>
            <input type="search" id="post-search-input" name="s" value="">
            <input type="submit" id="search-submit" class="button" value="Search Courses"></p>

        <input type="hidden" name="post_status" class="post_status_page" value="all">
        <input type="hidden" name="post_type" class="post_type_page" value="course">



        <input type="hidden" id="_wpnonce" name="_wpnonce" value="2a8c4a228e"><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit.php?post_type=course">	<div class="tablenav top">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label><select name="action" id="bulk-action-selector-top">
                    <option value="-1">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" id="doaction" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
                <label for="filter-by-date" class="screen-reader-text">Filter by date</label>
                <select name="m" id="filter-by-date">
                    <option selected="selected" value="0">All dates</option>
                    <option value="201712">December 2017</option>
                </select>
                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">		</div>
            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>
        <h2 class="screen-reader-text">Posts list</h2><table class="wp-list-table widefat fixed striped posts">
            <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td><th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://fishy-minds.localhost/wp-admin/edit.php?post_type=course&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th scope="col" id="author" class="manage-column column-author">Author</th><th scope="col" id="categories" class="manage-column column-categories">Categories</th><th scope="col" id="participants" class="manage-column column-participants">Participants</th><th scope="col" id="overall_progress" class="manage-column column-overall_progress">Overall progress</th><th scope="col" id="date" class="manage-column column-date sortable asc"><a href="http://fishy-minds.localhost/wp-admin/edit.php?post_type=course&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
            </thead>

            <tbody id="the-list">
            <tr id="post-4" class="iedit author-self level-0 post-4 type-course status-publish hentry">
                <th scope="row" class="check-column">			<label class="screen-reader-text" for="cb-select-4">Select Test</label>
                    <input id="cb-select-4" type="checkbox" name="post[]" value="4">
                    <div class="locked-indicator">
                        <span class="locked-indicator-icon" aria-hidden="true"></span>
                        <span class="screen-reader-text">“Test” is locked</span>
                    </div>
                </th><td class="title column-title has-row-actions column-primary page-title" data-colname="Title"><div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                    <strong><a class="row-title" href="http://fishy-minds.localhost/wp-admin/post.php?post=4&amp;action=edit" aria-label="“Test” (Edit)">Test</a></strong>

                    <div class="hidden" id="inline_4">
                        <div class="post_title">Test</div><div class="post_name">test</div>
                        <div class="post_author">1</div>
                        <div class="comment_status">closed</div>
                        <div class="ping_status">closed</div>
                        <div class="_status">publish</div>
                        <div class="jj">08</div>
                        <div class="mm">12</div>
                        <div class="aa">2017</div>
                        <div class="hh">17</div>
                        <div class="mn">19</div>
                        <div class="ss">12</div>
                        <div class="post_password"></div><div class="page_template">default</div><div class="post_category" id="course_category_4"></div><div class="sticky"></div></div><div class="row-actions"><span class="edit"><a href="http://fishy-minds.localhost/wp-admin/post.php?post=4&amp;action=edit" aria-label="Edit “Test”">Edit</a> | </span><span class="inline hide-if-no-js"><a href="#" class="editinline" aria-label="Quick edit “Test” inline">Quick&nbsp;Edit</a> | </span><span class="trash"><a href="http://fishy-minds.localhost/wp-admin/post.php?post=4&amp;action=trash&amp;_wpnonce=d797870690" class="submitdelete" aria-label="Move “Test” to the Trash">Trash</a> | </span><span class="view"><a href="http://fishy-minds.localhost/?course=test" rel="bookmark" aria-label="View “Test”">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td><td class="author column-author" data-colname="Author"><a href="edit.php?post_type=course&amp;author=1">Dmytro Sergiienko</a></td><td class="categories column-categories" data-colname="Categories"><a href="edit.php?post_type=course&amp;category_name=lorem-ipsum">Lorem ipsum</a></td><td class="participants column-participants" data-colname="Participants">0</td><td class="overall_progress column-overall_progress" data-colname="Overall progress">0%</td><td class="date column-date" data-colname="Date">Published<br><abbr title="2017/12/08 5:19:12 pm">2017/12/08</abbr></td>		</tr>
            </tbody>

            <tfoot>
            <tr>
                <td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></td><th scope="col" class="manage-column column-title column-primary sortable desc"><a href="http://fishy-minds.localhost/wp-admin/edit.php?post_type=course&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th scope="col" class="manage-column column-author">Author</th><th scope="col" class="manage-column column-categories">Categories</th><th scope="col" class="manage-column column-participants">Participants</th><th scope="col" class="manage-column column-overall_progress">Overall progress</th><th scope="col" class="manage-column column-date sortable asc"><a href="http://fishy-minds.localhost/wp-admin/edit.php?post_type=course&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
            </tfoot>

        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="action2" id="bulk-action-selector-bottom">
                    <option value="-1">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" id="doaction2" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
            </div>
            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>

    </form>


    <form method="get"><table style="display: none"><tbody id="inlineedit">

            <tr id="inline-edit" class="inline-edit-row inline-edit-row-post quick-edit-row quick-edit-row-post inline-edit-course" style="display: none"><td colspan="7" class="colspanchange">

                    <fieldset class="inline-edit-col-left">
                        <legend class="inline-edit-legend">Quick Edit</legend>
                        <div class="inline-edit-col">

                            <label>
                                <span class="title">Title</span>
                                <span class="input-text-wrap"><input type="text" name="post_title" class="ptitle" value=""></span>
                            </label>

                            <label>
                                <span class="title">Slug</span>
                                <span class="input-text-wrap"><input type="text" name="post_name" value=""></span>
                            </label>


                            <fieldset class="inline-edit-date">
                                <legend><span class="title">Date</span></legend>
                                <div class="timestamp-wrap"><label><span class="screen-reader-text">Month</span><select name="mm">
                                            <option value="01" data-text="Jan">01-Jan</option>
                                            <option value="02" data-text="Feb">02-Feb</option>
                                            <option value="03" data-text="Mar">03-Mar</option>
                                            <option value="04" data-text="Apr">04-Apr</option>
                                            <option value="05" data-text="May">05-May</option>
                                            <option value="06" data-text="Jun">06-Jun</option>
                                            <option value="07" data-text="Jul">07-Jul</option>
                                            <option value="08" data-text="Aug">08-Aug</option>
                                            <option value="09" data-text="Sep">09-Sep</option>
                                            <option value="10" data-text="Oct">10-Oct</option>
                                            <option value="11" data-text="Nov">11-Nov</option>
                                            <option value="12" data-text="Dec" selected="selected">12-Dec</option>
                                        </select></label> <label><span class="screen-reader-text">Day</span><input type="text" name="jj" value="08" size="2" maxlength="2" autocomplete="off"></label>, <label><span class="screen-reader-text">Year</span><input type="text" name="aa" value="2017" size="4" maxlength="4" autocomplete="off"></label> @ <label><span class="screen-reader-text">Hour</span><input type="text" name="hh" value="17" size="2" maxlength="2" autocomplete="off"></label>:<label><span class="screen-reader-text">Minute</span><input type="text" name="mn" value="19" size="2" maxlength="2" autocomplete="off"></label></div><input type="hidden" id="ss" name="ss" value="12">			</fieldset>
                            <br class="clear">

                            <div class="inline-edit-group wp-clearfix">
                                <label class="alignleft">
                                    <span class="title">Password</span>
                                    <span class="input-text-wrap"><input type="text" name="post_password" class="inline-edit-password-input" value=""></span>
                                </label>

                                <em class="alignleft inline-edit-or">
                                    –OR–				</em>
                                <label class="alignleft inline-edit-private">
                                    <input type="checkbox" name="keep_private" value="private">
                                    <span class="checkbox-title">Private</span>
                                </label>
                            </div>


                        </div></fieldset>


                    <fieldset class="inline-edit-col-center inline-edit-categories"><div class="inline-edit-col">


                            <span class="title inline-edit-categories-label">Categories</span>
                            <input type="hidden" name="tax_input[course_category][]" value="0">
                            <ul class="cat-checklist course_category-checklist">
                            </ul>


                        </div></fieldset>


                    <fieldset class="inline-edit-col-right"><div class="inline-edit-col">





                            <div class="inline-edit-group wp-clearfix">
                                <label class="inline-edit-status alignleft">
                                    <span class="title">Status</span>
                                    <select name="_status">
                                        <option value="publish">Published</option>
                                        <option value="future">Scheduled</option>
                                        <option value="pending">Pending Review</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </label>


                            </div>


                        </div></fieldset>

                    <div class="submit inline-edit-save">
                        <button type="button" class="button cancel alignleft">Cancel</button>
                        <input type="hidden" id="_inline_edit" name="_inline_edit" value="869aaa5094">				<button type="button" class="button button-primary save alignright">Update</button>
                        <span class="spinner"></span>
                        <input type="hidden" name="post_view" value="list">
                        <input type="hidden" name="screen" value="edit-course">
                        <input type="hidden" name="post_author" value="">
                        <br class="clear">
                        <div class="notice notice-error notice-alt inline hidden">
                            <p class="error"></p>
                        </div>
                    </div>
                </td></tr>

            <tr id="bulk-edit" class="inline-edit-row inline-edit-row-post bulk-edit-row bulk-edit-row-post bulk-edit-course" style="display: none"><td colspan="7" class="colspanchange">

                    <fieldset class="inline-edit-col-left">
                        <legend class="inline-edit-legend">Bulk Edit</legend>
                        <div class="inline-edit-col">
                            <div id="bulk-title-div">
                                <div id="bulk-titles"></div>
                            </div>



                        </div></fieldset><fieldset class="inline-edit-col-center inline-edit-categories"><div class="inline-edit-col">


                            <span class="title inline-edit-categories-label">Categories</span>
                            <input type="hidden" name="tax_input[course_category][]" value="0">
                            <ul class="cat-checklist course_category-checklist">
                            </ul>


                        </div></fieldset>


                    <fieldset class="inline-edit-col-right"><div class="inline-edit-col">





                            <div class="inline-edit-group wp-clearfix">
                                <label class="inline-edit-status alignleft">
                                    <span class="title">Status</span>
                                    <select name="_status">
                                        <option value="-1">— No Change —</option>
                                        <option value="publish">Published</option>

                                        <option value="private">Private</option>
                                        <option value="pending">Pending Review</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </label>


                            </div>


                        </div></fieldset>

                    <div class="submit inline-edit-save">
                        <button type="button" class="button cancel alignleft">Cancel</button>
                        <input type="submit" name="bulk_edit" id="bulk_edit" class="button button-primary alignright" value="Update">			<input type="hidden" name="post_view" value="list">
                        <input type="hidden" name="screen" value="edit-course">
                        <br class="clear">
                        <div class="notice notice-error notice-alt inline hidden">
                            <p class="error"></p>
                        </div>
                    </div>
                </td></tr>
            </tbody></table></form>

    <div id="ajax-response"></div>
    <br class="clear">
</div>
