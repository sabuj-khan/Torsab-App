<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Tag</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Tag Name *</label>
                                <input type="text" class="form-control" id="tagNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="UpdateTag()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function FillUpUpdateForm(id){
        showLoader();
        let response = await axios.get('/tag-by-id/'+id);
        hideLoader();

        document.getElementById('updateID').value = response.data['tag']['id'];
        document.getElementById('tagNameUpdate').value = response.data['tag']['name'];
    }


    async function UpdateTag(){
        let tagId = document.getElementById('updateID').value;
        let tagName = document.getElementById('tagNameUpdate').value;

        if(tagName.length == 0){
            errorToast('Tag name is required');
        }else{
            showLoader();
            let response = await axios.post('/tag-update', {"id":tagId, "name":tagName});
            hideLoader();

            if(response.status == 200 && response.data['status'] == 'success'){
                $('#update-modal').modal('hide');   
                successToast(response.data['message']);
                await getTagList();
                document.getElementById("update-form").reset();

            }else{
                successToast(response.data['message']);

            }


        }
    }



</script>