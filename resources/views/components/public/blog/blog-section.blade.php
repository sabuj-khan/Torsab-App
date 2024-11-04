<section>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="blog-posts" id="blog-post">

            
          </div>
          <ul class="pagination">
           
          </ul>
          <!-- end of pagination-->
        </div>
      </div>
      <!-- end of row-->

    </div>
  </section>


  <script>


    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;
    showAllPosts(currentPage);


    async function showAllPosts(page = 1){
      let allBlogs = jQuery("#blog-post");
      allBlogs.empty();

      let response = await axios.get(`/all-post-show?page=${page}`);

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
         
        let article = `<article class="post-single">
              <div class="post-info">
                <h2><a href="/singlePost?id=${item['id']}">${item['title']}</a></h2>
                <h6 class="upper"><span>By</span><a href="#"> ${item['user']['first_name']}</a><span class="dot"></span><span>${formattedDate}</span><span class="dot"></span><a href="#" class="post-tag">${item['tag']['name']}</a></h6>
              </div>
              <div class="post-media">
                <a href="/singlePost?id=${item['id']}">
                  <img src="${item['image']}" alt="">
                </a>
              </div>
              <div class="post-body">
                <p>${excerpt}</p>
                <p><a href="/singlePost?id=${item['id']}" class="btn btn-color btn-sm">Read More</a>
                </p>
              </div>
            </article>`

            allBlogs.append(article);


      });

       generatePagination(response.data['posts'], page);
       updateUrl(page);




    }



    function generatePagination(data, currentPage) {
    let pagination = jQuery(".pagination");
    pagination.empty();

    if (data.prev_page_url) {
      pagination.append(`<li><a href="?page=${currentPage - 1}" aria-label="Previous" onclick="showAllPosts(${currentPage - 1}); return false;"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a></li>`);
    }

    for (let i = 1; i <= data.last_page; i++) {
      pagination.append(`<li class="${i === currentPage ? 'active' : ''}"><a href="?page=${i}" onclick="showAllPosts(${i}); return false;">${i}</a></li>`);
    }

    if (data.next_page_url) {
      pagination.append(`<li><a href="?page=${currentPage + 1}" aria-label="Next" onclick="showAllPosts(${currentPage + 1}); return false;"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a></li>`);
    }
  }

  function updateUrl(page) {
    const url = new URL(window.location);
    url.searchParams.set('page', page);
    window.history.pushState({ path: url.href }, '', url.href);
  }



  </script>