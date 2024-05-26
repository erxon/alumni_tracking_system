<!--Tracer study-->
<div>
    <div class="bg-white p-4 rounded mb-3">
        <h5>Relevance of the Skills Acquired in SHS on the Curriculum
            Exits </h5>
        <p>
            The items on the following section are the skills essential
            for the curriculum exits. Please rate the relevance of each
            skill using the 4 point likert scale below:
        </p>
        <ul>
            <li>4 Strongly Agree</li>
            <li>3 Agree</li>
            <li>2 Fairly Agree</li>
            <li>1 Disagree</li>
        </ul>

        <div class="container-fluid bg-white p-3 rounded">
            <p>The Senior High School competencies has provided the
                learners with the following skills that are essential on the
                current exits they pursue:</p>

            <div class="d-flex">
                <div style="width: 20%"></div>
                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                    <p class="mb-1">4</p>
                    <p>Strongly Agree</p>
                </div>
                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                    <p class="mb-1">3</p>
                    <p>Agree</p>
                </div>
                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                    <p class="mb-1">2</p>
                    <p>Fairly Agree</p>
                </div>
                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                    <p class="mb-1">1</p>
                    <p>Disagree</p>
                </div>
            </div>
            <?php
            $sections = array(
                "Information, media and technology skills",
                "Learning and innovation skills",
                "Effective communication skills",
                "Life and career skills"
            );

            for ($i = 0; $i < count($sections); $i++) {
                $inputName = "tracer_survey_answer_" . ($i + 1);
            ?>
                <div class="d-flex bg-body-secondary align-items-center rounded mb-2">
                    <!--Question-->
                    <div class="p-2" style="width: 20%; font-size: 14px;">
                        <p><?php echo $sections[$i]; ?></p>
                    </div>
                    <!--Answers-->
                    <div class="flex-fill text-center" style="width: 20%;">
                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="4" required />
                    </div>
                    <div class="flex-fill text-center" style="width: 20%;">
                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="3" required />
                    </div>
                    <div class="flex-fill text-center" style="width: 20%;">
                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="2" required />
                    </div>
                    <div class="flex-fill text-center" style="width: 20%;">
                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="1" required />
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>