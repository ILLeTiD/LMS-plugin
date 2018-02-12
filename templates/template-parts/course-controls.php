<div class="course-controls">
    <div class="course-progress">

    </div>
    <div class="slide-controls">
        <button class="slide-control-fullscreen-option">
            <img src="<?php echo base_plugin_dir_url() ?>/assets/icons/PNG/Optons.png"
                 alt"back"=""></a>
        </button>
        <button class="slide-control-fullscreen slide-fullscreen">
            <img class="slide-control-fullscreen-in"
                 src="<?php echo base_plugin_dir_url() ?>/assets/icons/PNG/Maximize.png"
                 alt="Go fullscreen">
            <img class="slide-control-fullscreen-out"
                 src="<?php echo base_plugin_dir_url() ?>/assets/icons/PNG/Minimize.png"
                 alt="Go out fullscreen">
        </button>
        <div class="slide-control-audio">
            <audio src="" id="slide-control-player"
                   class="lms-audio"></audio>
        </div>
        <div class="slide-control-navigation">
            <div class="nav-button">
                <a href="#" class="prev" rel="prev">
                    <!--                    @TODO add helper function to get plugin root dir-->
                    <img src="<?php echo base_plugin_dir_url() ?>/assets/icons/PNG/Arrow-left.png"
                         alt"back"=""></a>
            </div>
            <div class="nav-button">
                <a href="#" class="next" rel="next">
                    <img src="<?php echo base_plugin_dir_url() ?>/assets/icons/PNG/Arrow-right.png"
                         alt"forward"=""></a>
            </div>
        </div>
    </div>
</div>