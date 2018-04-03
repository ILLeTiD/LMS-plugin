<div class="lms-courses-course__progress">
    <div class="lms-courses-course__done" id="done<?php echo get_the_ID(); ?>">
        <div class="lms-courses-course__progress-text">
            <p>


                <?php

                echo "Not started";
                ?>
                <!-- Style the progressbar according to user progress -->
                <style>
                    <?php echo '#done'.get_the_ID() ?>
                    {
                        width: 100%;
                        background-color: #ffffff;
                    }
                    <?php echo '#done'.get_the_ID() ?>
                    p {
                        color: #bfbfbf;
                    }
                </style>

            </p>
        </div>
    </div>

</div>