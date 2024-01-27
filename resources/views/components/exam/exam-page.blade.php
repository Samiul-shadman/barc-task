<div class="container">
    <div class="row">
        <div class="col">
            <div class="card ">
                <div class="card-body">
                    <h2 id="examTitle"></h2>              
                    <!-- <a href=""><h3>Take Exam</h3></a>  -->
                    <br>
                    <button onclick="takeExam(res.data.Exams.id)" class="btn w-20 bg-gradient-primary">Take Exam</button>
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
        } else {
            errorToast('No exams found in the response');
        }

        return res;
    }
    const data = getExam();
    console.log(data);
    examId = data.Exams.id;
    console.log(examId);
    

    async function takeExam(exam_id){
        showLoader();
        let post_data = await axios.post("/exam-page",{
            exam_id : exam_id,
        });
        hideLoader();
        if(post_data.data['status']==='success'){
            window.location.href="/exam-question/"+ exam_id;
        }
        else{
            errorToast(post_data.data['status']);
        }

    }
    
</script>