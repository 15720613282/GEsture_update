(function($) {
    $.fn.fixDiv = function(options) {
        var defaultVal = {
            top: 10
        };
        var obj = $.extend(defaultVal, options);
		$this = this;
        var _top = $this.offset().top;
        var _left = $this.offset().left;
        $(window).scroll(function() {
            var _currentTop = $this.offset().top;
            var _scrollTop = $(document).scrollTop();
            if (_scrollTop > _top) {
                $this.offset({
                    top: _scrollTop + obj.top,
                    left: _left
                });
            } else {
                $this.offset({
                    top: _top,
                    left: _left
                });
            }
        });
        return $this; //固定搜索框
    };
})(jQuery);
$(function(){
	$("#search_box").fixDiv({ top: 0 });//调用

	$('#search_btn').click(highlight);//点击search时，执行highlight函数；
	$('#searchstr').keydown(function (e) {
	    var key = e.which;
	    if (key == 13) highlight();
	})

	var tipsDiv='<div id="tip"></div>';
	$('body').append(tipsDiv);
	function showTips (text, top, time, left) {  //提示框显示方法
    var $tip = $('#tip');
	
    $tip.text(text);
    $tip.css({
      top: parseInt(top, 10) + 'px',
      left: parseInt(left, 10) + 'px'
	
    });
	
    $tip.show();
	setTimeout( function(){$tip.fadeOut();}, ( time * 1000 ) ); //提示信息消失

  }
   
  
  
	var i = 0;
	var sCurText;
	
	function highlight(){
		clearSelection();//先清空一下上次高亮显示的内容；
		
		var flag = 0;
	    var bStart = true;
		
		
		$('#tip').text('');
	    $('#tip').hide();
	    var searchText = $('#searchstr').val();
		var _searchTop = $('#searchstr').offset().top+30;
		var _searchLeft = $('#searchstr').offset().left;
		if($.trim(searchText)=="" || $.trim(searchText)=='.'){
		
			showTips("Please input the species name",_searchTop,1.5,_searchLeft);
			
			return;
		}
			//查找匹配
		var searchText = $('#searchstr').val();//获取你输入的关键字；
		var regExp = new RegExp(searchText, 'g');//创建正则表达式，g表示全局的；
		var content = $("#insect-list").text();
		if (!regExp.test(content)) {
			showTips("Not found",_searchTop,1.5,_searchLeft);
	       
			return;
	    } else {
	        if (sCurText != searchText) {
	            i = 0;
	            sCurText = searchText;
	         }
             
	     }
         console.log(sCurText)
		//高亮显示
		$('.fa-hover').children('a').each(function(){
			var icon ="<i class='fa fa-folder-o' aria-hidden='true'></i>" 
			var html = $(this).text();
			var newHtml = html.replace(regExp, '<span class="highlight">'+searchText+'</span>');//将找到的关键字替换，加上highlight属性；

			$(this).html(icon+newHtml);//更新；
			flag = 1;
		});
		
    }
	
	//清空高亮显示
	function clearSelection(){
		$('#insect-list').children().each(function(){
			//找到所有highlight属性的元素；
			$(this).find('.highlight').each(function(){
				$(this).replaceWith($(this).html());//将他们的属性去掉；
			});
		});
	}

	resizePre = function(){
		var x = $('body').width();
		var y = $('.fa-hover');
		y.css('clear', 'none');
		$('.fa-hover').css('float', 'left');
		if (x > 980) {
			$('.fa-hover').css('width', '25%');
			y.each(function(i, v){
				if (i % 4 == 0) {
					$(v).css('clear', 'left');
				}
			})
		}else if (x > 600) {
			$('.fa-hover').css('width', '33.33%');
			y.each(function(i, v){
				if (i % 3 == 0) {
					$(v).css('clear', 'left');
				}
			})
		}else if (x > 400) {
			$('.fa-hover').css('width', '50%');
			y.each(function(i, v){
				if (i % 2 == 0) {
					$(v).css('clear', 'left');
				}
			})
		}else{
			$('.fa-hover').css('width', '100%');
		}
	}
	resizePre();
	$(window).resize(function(event) {
		resizePre();
	});
	 
});

