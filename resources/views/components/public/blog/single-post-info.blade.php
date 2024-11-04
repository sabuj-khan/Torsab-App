<section>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="single-post">
                <article class="post-single">
                    <div class="post-info text-center">
                      <h2 id="postTitle"></h2>
                      <h6 class="upper"><span>By</span><a id="postAuthor" href="#"> Admin</a><span class="dot"></span><span id="postTime">28 September 2015</span><span class="dot"></span><a href="#" class="post-tag" id="postTag"></a></h6>
                    </div>
                    <div class="post-media text-center">
                      <img id="postImage" src="images/blog/1.jpg" alt="">
                    </div>
                    <div class="post-body" id="postContent">
                      
                    </div>
                  </article>
            </div>
          
          
          
        </div>
      </div>
    </div>
  </section>



  <script>

  getSinglePostDetails();

    async function getSinglePostDetails(){
        let urlParams = new URLSearchParams(window.location.search);
        let id = urlParams.get('id');

        let response = await axios.get('/post-single/'+id);

        document.getElementById('postTitle').innerText = response.data['post']['title'];
        document.getElementById('postContent').innerText = response.data['post']['content'];
        document.getElementById('postImage').src = response.data['post']['image']
        document.getElementById('postAuthor').innerText = response.data['post']['user']['first_name']
        document.getElementById('postTag').innerText = response.data['post']['tag']['name']

        function formatDate(dateString) {
            let options = { year: 'numeric', month: 'long', day: '2-digit' };
            return new Date(dateString).toLocaleDateString('en-GB', options);
        }
        let formattedDate = formatDate(response.data['post']['created_at']);

        document.getElementById('postTime').innerText = formattedDate
        
    }



  </script>