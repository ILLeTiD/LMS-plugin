<p class="search-box">
    <label class="screen-reader-text" for="post-search-input">
        <?= __('Search Courses', 'lms-plugin'); ?>:
    </label>
    <input type="search" id="post-search-input" name="s" value="<?= $s; ?>">
    <input type="submit"
           id="search-submit"
           class="button"
           value="<?= __('Search Courses', 'lms-plugin'); ?>">
</p>
