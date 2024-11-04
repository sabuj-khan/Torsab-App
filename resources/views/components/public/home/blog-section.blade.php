<section>
    <div class="container">
      <div class="title center">
        <h4 class="upper">We have a few tips for you.</h4>
        <h2>The Blog<span class="red-dot"></span></h2>
        <hr>
      </div>
      <div class="section-content">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">

            <div id="blogSec">
              
            </div>

          </div>
        </div>
        <!-- end of row-->
        <div class="clearfix"></div>
        <div class="mt-25">
          <p class="text-center"><a href="{{ asset('/blogPage') }}" class="btn btn-color-out">View Full Blog          </a>
          </p>
        </div>
      </div>
      <!-- end of container-->
    </div>
  </section>


  <script>

    getBlogOnhomePage();

    async function getBlogOnhomePage(){
      let blogSec = jQuery("#blogSec");
      blogSec.empty();

      let response = await axios.get('/all-post-show');

       // Function to format date to 'YYYY-MM-DD'
       function formatDate(dateString) {
            let options = { year: 'numeric', month: 'long', day: '2-digit' };
            return new Date(dateString).toLocaleDateString('en-GB', options);
        }

         // Function to get the first 50 words as an excerpt
        function getExcerpt(content, wordCount) {
          return content.split(" ").slice(0, wordCount).join(" ") + "...";
        }

      response.data['posts']['data'].forEach(function(item, index){
        let formattedDate = formatDate(item['created_at']);
        let excerpt = getExcerpt(item['content'], 30);
         
        let article = `<div class="blog-post">
                <div class="post-body">
                  <h3 class="serif"><a href="/singlePost?id=${item['id']}">${item['title']}</a></h3>
                  <hr>
                  <p class="serif">${excerpt}</p>
                  <div class="post-info upper"><a href="/singlePost?id=${item['id']}">Read More</a><span class="pull-right black-text">${formattedDate}</span>
                  </div>
                </div>
                <!-- end of blog post-->
              </div>`

              blogSec.append(article);


      });




    }



  </script>




