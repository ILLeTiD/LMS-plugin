
<div class="lms-courses-course__progress">
    <div class="lms-courses-course__done" id="done<?php echo $courseIndex ?>">
        <div class="lms-courses-course__progress-text">
            <p>

                <style>
                    <?php echo '#done'.$courseIndex ?>
                    {
                        width: <?php echo $enrollment->progress; ?>%;
                        flex: none;
                    }
                </style>

                <?php
                // Determine if the course is done, not started or in progress
                if ($enrollment->status == 'invited') {
                    echo "Invited";
                    ?>
                    <!-- Style the progressbar according to user progress -->
                    <style>
                        <?php echo '#done'.$courseIndex ?>
                        {
                            width: 100%;
                            background-color: #ffffff;
                        }
                        <?php echo '#done'.$courseIndex ?>
                        p {
                            color: #bfbfbf;
                        }
                    </style>

                    <?php } elseif ($enrollment->status == 'enrolled') { ?>
                 <?php   echo "Not started";
                    ?>
                    <!-- Style the progressbar according to user progress -->
                    <style>
                        <?php echo '#done'.$courseIndex ?>
                        {
                            width: 100%;
                            background-color: #ffffff;
                        }
                        <?php echo '#done'.$courseIndex ?>
                        p {
                            color: #bfbfbf;
                        }
                    </style>
                <?php } elseif ($enrollment->status == 'completed') { ?>
                <style>
                    <?php echo '#done'.$courseIndex ?>
                    {
                        width:100%;
                        flex: none;
                    }
                </style>
                   <?php echo "Completed";
                } else {
                    echo $enrollment->progress . '%';
                }
                $currentCourseNo++; ?></p>
        </div>
    </div>

</div>