<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h6>Users</h6>
                </div>

                {{-- <div class="align-items-end col pb-1" style="text-align:end">                    
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary btn-secondary createBtn">Add New Category</button>
                </div> --}}

            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table  table-flush" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>

     getUsersList();

async function getUsersList(){
    let tableData = $("#tableData");
    let tableList = $("#tableList");

    tableData.DataTable().destroy();
    tableList.empty();

    showLoader();
    let response = await axios.get('/all-users');
    hideLoader();

    response.data['users'].forEach(function(item, index){
    let row = `<tr>
                <td>${index+1}</td>
                <td>${item['first_name']}</td>
                <td>${item['last_name']}</td>
                <td>${item['email']}</td>
                <td>${item['mobile']}</td>
                <td>${item['user_type']}</td>
             </tr>`
             tableList.append(row);
   });



   new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
    });

   
}


</script>