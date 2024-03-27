<div class="modal fade" id="edit-question" tabindex="-1">
    <div class="modal-dialog">
        <form id="edit-question-form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Question-->
                    <input hidden name="surveyId" value="<?php echo $id ?>" />
                    <input hidden id ="edit_question_question_id" name="question_id" value="<?php echo $question[0]; ?>" />
                    <input class="form-control mb-1" name="question" value="<?php echo $question[1]; ?>" placeholder="Question" required />
                    <!--Answer-->
                    <div class="d-flex mb-3">
                        <input id="edit-question-answer" class="form-control me-2 flex-fill" name="answer" value="" placeholder="Answer" />
                        <button id="edit-question-add-answer" type="button" class="btn btn-sm btn-light flex-fill"><i class="fas fa-plus"></i></button>
                    </div>
                    <!--Answer List-->
                    <p id="edit-answer-validation" style="display: none" class="m-0 text-danger">You should have at least 2 answers</p>
                    <div id="edit-answer-list-container">
                        <?php for ($i = 0; $i < count($answers); $i++) { ?>
                            <div class="d-flex">
                                <input name="<?php echo "answer_$i"; ?>" class="form-control mb-2 me-2" value="<?php echo $answers[$i][1]; ?>" readonly />
                                <button onclick="editRemoveAnswer('<?php echo $answers[$i][3] ?>', '<?php echo $answers[$i][2] ?>')" type="button" id="edit-remove-answer" class="btn btn-light"><i class="fas fa-minus"></i></button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>