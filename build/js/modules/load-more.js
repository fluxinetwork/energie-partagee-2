/*
 * Load more projects on trio-projects
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
                var $firstItem = $('.trio-card .box .box__half:eq(0)');
                var $secondItem = $('.trio-card .box .box__half:eq(1)');
                var content ='<a class="card card-project anim-out" href="'+data[i].permalink+'"><div class="card__img"><img class="img-reponsive" src="'+data[i].image+'"><i class="card__icon icon-uniE60F"></i></div><div class="card__infos"><h1 class="card__title">'+data[i].title+'</h1><p class="p-ss">'+data[i].region+'</p></div></a>';

                if(i > 0){
                    $secondItem.find('.card-project').addClass('anim-out');
                    setTimeout(function() {
                        $secondItem.find('.card-project').remove();
                        $secondItem.append(content);
                        setTimeout(function() {
                            $secondItem.find('.card-project').removeClass('anim-out');
                        }, 50);
                    }, 220);

                }else{
                    $firstItem.find('.card-project').addClass('anim-out');
                    setTimeout(function() {
                        $firstItem.find('.card-project').remove();
                        $firstItem.append(content);
                        setTimeout(function() {
                            $firstItem.find('.card-project').removeClass('anim-out');
                        }, 50);
                    }, 220);
                }

            });

            if(limiteProjectLoading < 2){
                $('.js-more-project').attr('disabled',false);
            }else{$('.js-more-project').remove();
                $('.trio-card .box__fixe').append('<a href="/projets/" class="button-round grey"><i class="icon-plus_64"></i></a>');
            }

        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false;


}
/*
 * Load more projects on mobil page projects
 * Return JSON
 */
function initLoadMoreProjectsCardsBtn (){
    $('.js-more-procards').attr('disabled',false);
    $('.js-more-procards').on( 'click', function ( e ) {
        e.preventDefault();
        $('.js-more-procards').attr('disabled',true);
        loadMoreProjectsCards();
    });
}
function loadMoreProjectsCards(){

    offsetProject = offsetProject + 6;

    var nbTotalCards = $('.map-projects').data('nbcards');

    var str = 'offset='+offsetProject+'&posts_per_page=6&action=more_project_ajax';

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){

            $.each(data, function(i){

                nbloadedCards++;

                var categoryNRJ = (data[i].catSlug).substring(0, 5);

                var cardContent = '<article class="card-map c-'+categoryNRJ+' anim-out">';
                        cardContent += '<header class="card card-project">';
                            cardContent += '<a href="'+data[i].permalink+'">';
                                cardContent += '<div class="card__img" style="background-image:url('+data[i].image+')"><i class="card__icon"></i><span class="tag is-inactive">'+data[i].stadeName+'</span></div>';
                                cardContent += '<div class="card__infos"><h1 class="card__title">'+data[i].title+'</h1><p class="p-ss">'+data[i].region+'</p></div>';
                            cardContent += '</a>';
                        cardContent += '</header>';
                    cardContent += '</article>';

                addCardContent(cardContent, nbloadedCards-1, i);

                if(nbloadedCards < nbTotalCards-1){
                    $('.js-more-procards').attr('disabled',false);
                } else{
                    $('.js-more-procards').parent().hide(300);
                }
            });

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
/*
 * Load 
 * @param : category (number)
 */
function loadPosts(category){
    pageNumber++;

    var totalposts = $('.fluxi-content').data('totalposts');

    var str = '&cat=' + category + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
            var $data = $(data);
            nbTotalPostLoaded = nbTotalPostLoaded + $data.length;
            if($data.length > 1){

                $('.js-inject-news').append($data);

                for(var i = 0; i <= $data.length; i++){
                    setTimeout(function() {
                        $('.card-news').removeClass('anim-out');
                    }, 200*i);
                }

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

/*
 * Add and animate content of ajax loaded object
 * @param : content (jquery | html) => html or jquery element
 * @param : domId (number) => element index in the page
 * @param : factor (number) => index to factor the animation delay
 */
function addCardContent (content, domId, factor){

    $('.cards-map').append(content);

    setTimeout(function() {
        $('.cards-map').find('.card-map:eq('+domId+')').removeClass('anim-out');
    }, 200*factor);
}



