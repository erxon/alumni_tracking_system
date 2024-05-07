<div class="row">
    <input hidden name="additionalFields" value="<?php echo count($additionalInformation); ?>" />
    <?php $increment = 0; ?>
    <?php foreach ($additionalInformation as $additionalInfoField) { ?>

        <div class="col-6 mb-2">
            <input hidden name="field-id-<?php echo $increment ?>" value="<?php echo $additionalInfoField[0]; ?>" />
            <?php
            if ($additionalInfoField[3] == "user_defined") { ?>
                <div class="form-floating">
                    <input name="field-<?php echo $increment; ?>" id="<?php echo $additionalInfoField[0] ?>" type="text" placeholder="<?php echo $additionalInfoField[1]; ?>" class="form-control additional-field <?php if ($additionalInfoField[2] == "date") {
                                                                                                                                                                                                                        echo "datepicker";
                                                                                                                                                                                                                    } ?>" value="" />
                    <label for="<?php echo $additionalInfoField[0] ?>"><?php echo $additionalInfoField[1]; ?></label>
                </div>
            <?php } else if ($additionalInfoField[3] == "multiple_choice") { ?>
                <div class="form-floating">
                    <select name="field-<?php echo $increment; ?>" id="<?php echo $additionalInfoField[0]; ?>" class="form-control additional-field">
                        <option selected value="">Select <?php echo $additionalInfoField[1] ?></option>
                        <?php
                        $choices = $field->getChoices($additionalInfoField[0]);
                        foreach ($choices as $choice) { ?>
                            <option value="<?php echo $choice["id"]; ?>">
                                <?php echo $choice["choiceName"] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label class="mb-2" for="<?php echo $additionalInfoField[0]; ?>"><?php echo $additionalInfoField[1]; ?></label>
                </div>
            <?php } ?>
        </div>
        <?php $increment++; ?>
    <?php } ?>
</div>