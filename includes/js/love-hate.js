jQuery(document).ready( function($) {	
//for toggles-widgets
        $(".block-hated").hide();
        $(".hatebut").show();
 	    $(".block-loved").hide();
        $(".lovebut").show();
//dislike button hit: 
	$('.hate-it').on('click', function() {

		var $this = $(this);	
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var data = {
			action: 'hate_it',
			item_id: post_id,
			user_id: user_id,
			hate_it_nonce: hate_it_vars.nonce
		};
		
			if($this.hasClass('hated')) {
			return false;
		}

		if($.cookie('lh-' + post_id)) {
				$("a.hatebut").css('color','#ccc');
			return false;
		}
		
		$.post(hate_it_vars.ajaxurl, data, function(response) {
			if(response == 'hated') {
			 $(".block-hated").slideToggle();
				$this.addClass('hated');
				$this.removeClass('hate-it');	
				$('.love-it').removeClass('love-it');
				var count_wrap = $this.next();
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);
			
					$.cookie('lh-' + post_id, 'yes', { expires: 7 });
				
				
			} else {
				$("a.hatebut").css('color','#ebebeb !important');
			}
			return false;
		});
		return false;
	});	
	
var line_width = $(".rate-line").width();	
//	taking amount of votes
var hate_counter = $("span.hate-count").text();
var love_counter = $("span.love-count").text();
//if no votes - line is grey
var koef = Number(hate_counter) + Number(love_counter);
if(Number(koef)==0) {
$(".rate-line").css('background','#ebebeb')
};
//calculating percent
koef = (line_width-((line_width/koef)*hate_counter));
$(".hate-counter").html(hate_counter + ' dislikes');
$(".love-counter").html(love_counter + ' likes');
$(".rate-line").css('background-position',+ koef +'px 0px');
	
//like-button hit	
	$('.love-it').on('click', function() {
		
		var $this = $(this);	
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var data = {
			action: 'love_it',
			item_id: post_id,
			user_id: user_id,
			love_it_nonce: love_it_vars.nonce
		};
		
		// don't allow the user to love the item more than once
		if($this.hasClass('loved')) {
			return false;
		}	
		if($.cookie('lh-' + post_id)) {
		$("a.lovebut").css('color','#ccc');
			return false;
			
		}
		
		$.post(love_it_vars.ajaxurl, data, function(response) {
			if(response == 'loved') {
			$(".block-loved").slideToggle();
				$this.addClass('loved');
				$this.removeClass('love-it');
				$('.hate-it').removeClass('hate-it');
				var count_wrap = $this.next();
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);
				
					$.cookie('lh-' + post_id, 'yes', { expires: 7 });
			
			} else {
				$("a.lovebut").css('color','#ccc');return false;
			}
		});
		$("a.lovebut").css('color','#ccc');return false;
	});	
	
});
