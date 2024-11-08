<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <button onclick="VerifyEmail()"  class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    async function VerifyEmail(){
        let email = document.getElementById('email').value;

        if(email.length == 0){
            errorToast('Email is required');
        }else{
            showLoader();
            let response = await axios.post('/send-otp', {"email":email});
            hideLoader();

            if(response.status == 200 && response.data['status'] == 'success'){
                successToast(response.data['message']);
                sessionStorage.setItem('email', email);
                setTimeout(function (){
                    window.location.href='/otpVerify'
                },500)
            }else{
                successToast(response.data['message']);
            }
            
        }
    }


</script>