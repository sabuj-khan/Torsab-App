<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h6>Category</h6>
                </div>
                <div class="align-items-end col pb-1" style="text-align:end">
                    
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary btn-secondary createBtn">Add New Category</button>


                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table  table-flush" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Category</th>
                    <th>Action</th>
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

 getCategoryList();

async function getCategoryList(){
    let tableData = $("#tableData");
    let tableList = $("#tableList");

    tableData.DataTable().destroy();
    tableList.empty();

    
    let response = await axios.get('/category-show');
    

    response.data['category'].forEach(function(item, index){
    let row = `<tr>
                <td>${index+1}</td>
                <td>${item['name']}</td>
                <td>
                    <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                </td>
             </tr>`
             tableList.append(row);
   });


   $(".createBtn").on('click', function(){           
        $("#create-modal").modal('show');
   });

   
   $(".editBtn").on('click', function(){
        let id = $(this).data("id");
        fillupcategory(id);
        $("#update-modal").modal('show');
    });
    

   $(".deleteBtn").on('click', function(){
        let id = $(this).data("id");
       // await FillDeleteForm(id);
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
   });



   new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
    });

   
}


</script>
