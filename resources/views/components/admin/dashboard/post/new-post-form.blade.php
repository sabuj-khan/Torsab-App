<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="form-container">
                <h2 class="mb-4">Add New Post</h2>
                <form id="save-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="postTitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="postContent" name="content" rows="5" ></textarea>
                    </div>


                    {{-- <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div> --}}


                    <img class="" width="200" height="150" id="newImg" src="{{asset('assets/images/demo.jpg')}}"/>
                    <br/>

                    <label class="form-label">Image</label>
                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="postImg">




                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="postCategory" name="category_id" >
                            <option value="">Select a category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Tags</label>
                        <select class="form-control" id="postTag" name="tag_id" >
                            <option value="">Select Tag</option>
                        </select>
                    </div>
                    
                    {{-- <div class="form-group">
                        <label for="tags">Tags</label>
                        <input style="background-color: hsla(218, 10%, 22%, 0.007)" type="text" class="form-control custom-input" id="postTags" name="tags" placeholder="Enter tags separated by commas">
                    </div> --}}

                </form>
                
                <button onclick="savePost()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>



<script>

    fillCategoryOption();

    async function fillCategoryOption(){
        
        let response = await axios.get('/category-show')
    

        response.data['category'].forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#postCategory").append(option);
        });
    }


    fillTagOption();
    async function fillTagOption(){
        
        let response = await axios.get('/tag-show')
       

        response.data['tag'].forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#postTag").append(option);
        });
    }



    async function savePost(){
        let postTitle = document.getElementById('postTitle').value;
        let postContent = document.getElementById('postContent').value;
        let categoryId = document.getElementById('postCategory').value;
        let tagId = document.getElementById('postTag').value;
        let postImage = document.getElementById('postImg').files[0];

        if(postTitle.length == 0){
            errorToast('Type your title');
        }else if(postContent.length == 0){
            errorToast('Type the content');
        }else if(categoryId.length == 0){
            errorToast('Select the category');
        }else if(tagId.length == 0){
            errorToast('Select the tag');
        }else{
            let formData = new FormData();

            formData.append('title',postTitle);
            formData.append('content',postContent);
            formData.append('image',postImage);
            formData.append('category_id',categoryId);
            formData.append('tag_id',tagId);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let response = await axios.post('/post-create', formData, config);
            hideLoader();

            if(response.status == 201 && response.data['status'] == 'success'){
                successToast(response.data['message']);
                document.getElementById("save-form").reset();
            
                setTimeout(function (){
                        window.location.href='/allPosts'
                    },500)
            }else{
                errorToast(response.data['message']);
            }


        }
    }




</script>
