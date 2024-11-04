<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h6>Tag</h6>
                </div>
                <div class="align-items-end col pb-1" style="text-align:end">
                    
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary btn-secondary createTagBtn">Add New Tag</button>


                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table  table-flush" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Tags</th>
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

    getTagList();

    async function getTagList(){
        let tableData = $("#tableData");
        let tableList = $("#tableList");

        tableData.DataTable().destroy();
        tableList.empty();

        showLoader();
        let response = await axios.get('/tag-show');
        hideLoader();

        response.data['tag'].forEach(function(item, index){
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
                 tableList.append(row);
        })

        $(".createTagBtn").on('click', function(){           
            $("#create-modal").modal('show');
        });


        $(".editBtn").on('click', function(){
            let id = $(this).data("id");
             FillUpUpdateForm(id);
            $("#update-modal").modal('show');
       });


       $(".deleteBtn").on('click', function(){
            let id = $(this).data("id");
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
       });



        
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });


    }



</script>




