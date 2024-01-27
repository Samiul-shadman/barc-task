<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>{{ $question->Exam_name }}</h4>
                    </div>
                    <!-- <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div> -->
                </div>
                <hr class="bg-dark " />
            </div>
        </div>
    </div>

    <br>

    <hr>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <form method="post" action="{{ url('/ans-store', $question->id) }}">
                    @csrf
                    <div class="form-group ">
                        <label for="Question_1">
                            <h5>{{ $question->Exam_question_1 }}</h5>
                        </label>
                        <input type="text" class="form-control" name="Exam_ans_1" id="ans_1">
                    </div>
                    <div class="form-group">
                        <label for="Question_2">
                            <h5>{{ $question->Exam_question_2 }}</h5>
                        </label>
                        <input type="text" class="form-control" name="Exam_ans_2" id="ans_2">
                    </div>
                    <div class="form-group">
                        <label for="Question_3">
                            <h5>{{ $question->Exam_question_3 }}</h5>
                        </label>
                        <input type="text" class="form-control" name="Exam_ans_3" id="ans_3">
                    </div>
                    <div class="form-group">
                        <label for="Question_4">
                            <h5>{{ $question->Exam_question_4 }}</h5>
                        </label>
                        <!-- <input type="radio" class="form-control" id="ans_4"> -->
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_4" id="radio1"
                                value="option1">
                            <label class="form-check-label" >
                                Radio 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_4" id="radio2"
                                value="option2">
                            <label class="form-check-label" >
                                Radio 2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_4" id="radio3"
                                value="option3" >
                            <label class="form-check-label" >
                                Radio 3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_4" id="radio4"
                                value="option3" >
                            <label class="form-check-label" >
                                Radio 4
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Question_5">
                            <h5>{{ $question->Exam_question_5 }}</h5>
                        </label>
                        <!-- <input type="radio" class="form-control" id="ans_5"> -->
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_5" id="radio1"
                                value="option1">
                            <label class="form-check-label" >
                                Radio 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_5" id="radio2"
                                value="option2">
                            <label class="form-check-label" >
                                Radio 2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_5" id="radio3"
                                value="option3" >
                            <label class="form-check-label" >
                                Radio 3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Exam_ans_5" id="radio4"
                                value="option3" >
                            <label class="form-check-label" >
                                Radio 4
                            </label>
                        </div>
                    </div>

                    <br><hr>

                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-start btn m-0 bg-gradient-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<!-- 
<script>

    getQuestions();

    async function getQuestions(){
        showLoader();
        let question = async axios.get('/exam-question');
    }

</script> -->