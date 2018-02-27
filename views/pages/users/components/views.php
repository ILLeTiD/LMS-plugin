<h2 class="screen-reader-text">
    <?= __('Filter users list', 'lms-plugin'); ?>
</h2>

<ul class="subsubsub">
    <?php foreach ($views as $name => $view): ?>
        <li class="<?= $name; ?>">
            <a href="<?= $view['link']; ?>"
               <?= $name == $current_view ? ' class="current" aria-current="page"' : ''; ?>
            >
                <?= $view['label']; ?>
                <span class="count">(<?= $view['total']; ?>)</span>
            </a>
            <?= $view !== end($views) ? ' | ' : ''; ?>
        </li>
    <?php endforeach; ?>
</ul>

