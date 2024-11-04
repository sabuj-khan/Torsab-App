<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="DeleteTag()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

async function DeleteTag(){
        let tagId = document.getElementById('deleteID').value;

        let response = await axios.post('/tag-delete', {"id":tagId});

        if(response.status == 200 && response.data['status'] == 'success'){
            $('#delete-modal').modal('hide');
            successToast(response.data['message']);
            await getTagList();
        }else{
            errorToast(response.data['message']);
        }

    }

</script>






