<div class="course-controls">
    <div class="course-progress">

    </div>
    <div class="slide-controls">
        <button class="slide-control-fullscreen slide-fullscreen">toggle fullscreen</button>
        <div class="slide-control-audio">
            <audio src="" id="slide-control-player"
                   class="lms-audio"></audio>
        </div>
        <div class="slide-navigation">
            <div class="nav-button">
                <a href="#" class="prev" rel="prev">
                    <!--                    @TODO add helper function to get plugin root dir-->
                    <img src="<?php echo plugin_dir_url(__FILE__) ?>/../../../assets/images/etp_arrow-left_over.png"
                         alt"back"=""></a>
            </div>
            <div class="nav-button">
                <a href="#" class="next" rel="next">
                    <img src="<?php echo plugin_dir_url(__FILE__) ?>/../../../assets/images/etp_arrow-right_over.png"
                         alt"forward"=""></a>
            </div>
        </div>
    </div>
</div>