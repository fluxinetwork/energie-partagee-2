/* 
 * Load more projects
 * Return JSON
 */
function initLoadMoreProjectsBtn (){
	$('.js-more-project').attr('disabled',false);	
	$('.js-more-project').on( 'click', function ( e ) {		
		e.preventDefault();
		$('.js-more-project').attr('disabled',true);			
		loadMoreProjects();
	});
}

function loadMoreProjects(){	
	
    offsetProject = offsetProject + 2;
	limiteProjectLoading++;
	
    var str = 'offset='+offsetProject+'&action=more_project_ajax';
	
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
						
			$.each(data, function(i){
				
				var content ='<a class="card card-project is-flip-out" href="'+data[i].permalink+'"><div class="card__img"><img class="img-reponsive" src="'+data[i].image+'"><i class="card__icon icon-uniE60F"></i></div><div class="card__infos"><h1 class="card__title">'+data[i].title+'</h1><p class="p-ss">'+data[i].region+'</p></div></a>';
				
				if(i > 0){
					$('.trio-card .box .box__half:eq(1)').html('').append(content);
				}else{
					$('.trio-card .box .box__half:eq(0)').html('').append(content);
				}
				
        	});	
			
        	if(limiteProjectLoading < 2){
				$('.js-more-project').attr('disabled',false);
			}
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false; 
	
	
}



/* 
 * Load more news/event 
 * Return HTML
 */
function initLoadMorePostsBtn (){
	$('.js-more').on( 'click', function ( e ) {		
		e.preventDefault();
		$('.js-more').attr('disabled',true);
		
		var category = $(this).data('cat');		
		
		loadPosts(category);
	});
}

function loadPosts(category){
    pageNumber++;
    var str = '&cat=' + category + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length > 1){
                $('.fluxi-content .box').append($data);
                $('.js-more').attr('disabled',false);
            } else{
                $('.js-more').remove('disabled',true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false;
}




/* WP-JSON TEST
/*

function initLoadMoreBtn (){
	$('.load-more').on( 'click', function ( e ) {
		e.preventDefault();
		
		var category = $(this).data('cat');
		
		getPosts(category);
	});
}

function getPosts(category) {
    $.ajax({
        url: siteURL+'/wp-json/posts?filter[cat]=' + category + '&include[]=title&include[]=date&filter[posts_per_page]=12&filter[offset]=12',
        dataType: 'json',
        type: 'GET',
        success: function(data) {
			$('.fluxi-content').append('<h4 class="h4">— ' + data[0].title + '</h4>');
           // drawCountries(data);
			
        },
        error: function() {
			
            console.log('erreur JSON');
			
        }
    });
}

*/