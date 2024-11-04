<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-1 py-1">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>All Post</h4>
                </div>
                <div class="align-items-end col" style="text-align:end">
                    
                    <a href="{{ url('/addNewPosts') }}"><button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary btn-secondary">Add New Post</button></a>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Title</th>
                    {{-- <th>Content</th> --}}
                    <th>Author</th>
                    <th>Category</th>
                    <th>Tag</th>
                    <th>Image</th>
                    <th>Date</th>
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





<script>

    getPostList();

    async function getPostList(){
        let tableData = $("#tableData");
        let tableList = $("#tableList");

        tableData.DataTable().destroy();
        tableList.empty();

        let response = await axios.get('/all-post-dash');

        // Function to format date to 'YYYY-MM-DD'
        function formatDate(dateString) {
            let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return new Date(dateString).toLocaleDateString('en-CA', options);
        }

        response.data['posts'].forEach(function(item, index){
            let formattedDate = formatDate(item['created_at']);

            let row = `<tr>
                            <td>${index+1}</td>
                            <td>${item['title']}</td>
                            <td>${item['user']['first_name']}</td>
                            <td>${item['category']['name']}</td>
                            <td>${item['tag']['name']}</td>
                            <td><img class="" alt="" src="${item['image']}" width="50"></td>
                            <td>${formattedDate}</td>
                            <td>
                                <button data-path="${item['image']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-secondary"><i class="fa fa-edit"></i></button>

                                <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                       </tr>`;

                tableList.append(row);
            
        });


        $(".editBtn").on('click', async function() {
            let id = $(this).data('id');
            let path = $(this).data('path');

            // Save id and path to session storage
            sessionStorage.setItem('id', id);
            sessionStorage.setItem('path', path);
            
            // Redirect to the specified URL
            window.location.href = 'http://127.0.0.1:8000/updatePosts';
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