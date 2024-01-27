<div class="container">
    <div class="row">
        <div class="col">
            <div class="card ">
                <div class="card-body">
                    <h2 id="examTitle"></h2>              
                    <!-- <a href=""><h3>Take Exam</h3></a>  -->
                    <br>
                    <button onclick="takeExam()" id="examId" class="btn w-20 bg-gradient-primary">Take Exam</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getExam();

    
    async function getExam(){
        showLoader();
        let res =await axios.get("/user-exam");
        hideLoader();

        // console.log(res.data);
        // console.log(exam_id = res.data.Exams.id);
            
        if (res.data.Exams) {
            // Assuming 'Exam_name' is a property of the 'Exams' object
            examTitle.textContent = res.data.Exams.Exam_name;
            examId.value = res.data.Exams.id;

            console.log(examId);
        } else {
            errorToast('No exams found in the response');
        }

    }


    async function takeExam(){
        var exam_id = document.getElementById('examId').value;
        showLoader();
        let post_data = await axios.post("/exam-page",{
            exam_id : exam_id,
        });

        console.log(exam_id);
        hideLoader();
        if(post_data.data['status']==='success'){
            window.location.href="/page-question/"+ exam_id;
        }
        else{
            errorToast(post_data.data['status']);
        }
    }
    
</script>