<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="UpdateCategory()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>


    async function fillupcategory(id){
        showLoader();
        let response = await axios.get('/category-by-id/'+id);
        hideLoader();

        document.getElementById('updateID').value = response.data['category']['id'];
        document.getElementById('categoryNameUpdate').value = response.data['category']['name'];
    }

    async function UpdateCategory(){
        let catId = document.getElementById('updateID').value;
        let catName = document.getElementById('categoryNameUpdate').value;

        if(catName.length == 0){
            errorToast('Category name is required');
        }else{
            showLoader();
            let response = await axios.post('/category-update', {"id":catId, "name":catName});
            hideLoader();

            if(response.status == 200 && response.data['status'] == 'success'){
                $('#update-modal').modal('hide');       
                successToast(response.data['message']);
                document.getElementById("update-form").reset();
                await getCategoryList();
            }else{
                errorToast(response.data['message']);
            }

        }
    }


</script>