  var index;
  var playlist = [{artist: "傲娇的程序员",
  					mp3: "http://newradio.sky31.com/api/audio/117",
  					poster: "http://newradio.sky31.com/images/daotu.jpg",
  					title: "正在加载，你咬我呀～"
  				}];
  var cssSelector = {
    jPlayer: "#jquery_jplayer",
    cssSelectorAncestor: ".music-player"
  };
  var options = {
    swfPath: "Jplayer.swf",
    supplied: "ogv, m4v, oga, mp3"
  };

var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
  function selectMusic(plid,mpid)
  {
    myPlaylist.setPlaylist(playlist[plid]);
    myPlaylist.select(index[plid][mpid].index);
  	myPlaylist.play();
  }
  var playListMain = new Array();
$(document).ready(function(){

	  //reqChangYan(9);
	$.support.cors = true;
	$.ajax({
  		crossDomain : true,
              xhrFields: {
                  withCredentials: false
              },

		  url: "http://newradio.sky31.com/api/newest",
		  //url: "js/api.js",
		  type: "get",
		  dataType: "json",
		  success:function(data){

			  cssSelector = {
			    jPlayer: "#jquery_jplayer",
			    cssSelectorAncestor: ".music-player"
			  };

			  options = {
			    swfPath: "Jplayer.swf",
			    supplied: "ogv, m4v, oga, mp3"
			  };
			  $("#recommend .fiveul").empty();	//empty the ul;
			$.each(data.data, function (k, ktem) {
					/*
				        {
				          titlt:ktem.title,
				          artist:ktem.author,
				          mp3:ktem.audio.src,
				          poster:ktem.cover
				        }
				    */
				    if(ktem.author==null)
						ktem.author="主播";
					var mp3 = ktem.audio==null ? null : ktem.audio.src;
					var mp3id = ktem.audio.id;
					//console.log(mp3+" "+mp3id+" "+ktem.title+" "+playlist.length);
					var thumbnail = ktem.thumbnail==null ? ktem.cover : ktem.thumbnail;
					var background = ktem.background==null ? "http://newradio.sky31.com/images/bg.jpg" : ktem.background;
					var jtem = {
						title: ktem.title,
						artist: ktem.author,
						poster: ktem.cover,
						mp3: mp3,
						id: ktem.id,
						background: background
					};
					playListMain.push(jtem);
					//console.log(jtem);
					titleX = ktem.title;
					if (ktem.title.length>8)
						ktem.title = ktem.title.substring(0,8) + '...';
						$("#recommend .fiveul").append(
														"<li>"
															+"<a href=\""+"javascript:;"+"\" title=\""+titleX+"\" onclick=\"selectMusic2("+ktem.album_id+","+k+")\"><img src=\""+thumbnail+"\" /></a>"
															+"<a href=\""+"javascript:;"+"\" class=\"list_1\" title=\""+titleX+"\" onclick=\"selectMusic2("+ktem.album_id+","+k+")\">"+ktem.title+"</a><br>"
															+"<a href=\""+"javascript:;"+"\" class=\"list_2\">"+ktem.author+"</a>"
														+"</li>");
				});
 			 myPlaylist.setPlaylist(playListMain);
			 
			$('#content').append("<script>"
				+"function selectMusic2(plid,mpid)"
				+"{"
				+"	myPlaylist.setPlaylist(playListMain);"
				+"	myPlaylist.select(mpid);"
				+"	myPlaylist.play();"
				+"}"
				+"	</script>");

		}
	});
    			$.ajax({
			  		crossDomain : true,
			              xhrFields: {
			                  withCredentials: false
			              },

					  url: "http://newradio.sky31.com/api/all",
					  //url: "js/api.js",
					  type: "get",
					  dataType: "json",
					  async : false,
					  success:function(data){
					  cssSelector = {
					    jPlayer: "#jquery_jplayer",
					    cssSelectorAncestor: ".music-player"
					  };

					  options = {
					    swfPath: "Jplayer.swf",
					    supplied: "ogv, m4v, oga, mp3"
					  };
					  playlist = new Array();
					  index = new Array();
						$.each(data.seasons, function (i, item) {
							playlist[i] = new Array();
							index[i] = new Array();
							$.each(data.seasons[i].programs, function (k, ktem) {
							    if(ktem.author==null)
									ktem.author="主播";
								var mp3 = ktem.audio==null ? null : ktem.audio.src;
								var mp3id = ktem.audio.id;
								//console.log(mp3+" "+mp3id+" "+ktem.title+" "+playlist.length);
								var thumbnail = ktem.thumbnail==null ? ktem.cover : ktem.thumbnail;
								var background = ktem.background==null ? "http://newradio.sky31.com/images/bg.jpg" : ktem.background;
								var jtem = {
									title: ktem.title,
									artist: ktem.author,
									poster: ktem.cover,
									mp3: mp3,
									id: ktem.id,
									background: background
								};
								index[i][ktem.id] = new Object();

								index[i][ktem.id] = {
									id: ktem.id,
									index: k
								};
								playlist[i].push(jtem);

							  });
							});
						}
					});
  var flagSiji = 0;
	$('#sidertwo').click(function(){
		if(flagSiji==0){
			$.ajax({
			  		crossDomain : true,
			              xhrFields: {
			                  withCredentials: false
			              },

					  url: "http://newradio.sky31.com/api/all",
					  //url: "js/api.js",
					  type: "get",
					  dataType: "json",
					  success:function(data){
					  	/*$.each(data,i,items){
					  		alert(items.seasons[i].name);
					  	}*/

					  	//alert(playlist);

					  cssSelector = {
					    jPlayer: "#jquery_jplayer",
					    cssSelectorAncestor: ".music-player"
					  };

					  options = {
					    swfPath: "Jplayer.swf",
					    supplied: "ogv, m4v, oga, mp3"
					  };
					  playlist = new Array();
					  index = new Array();
					  /*playlist.push({
									title: "ktem.title",
									artist: "ktem.author",
									mp3: "mp3",
									poster: "ktem.cover"
								});*/

						$.each(data.seasons, function (i, item) {
							playlist[i] = new Array();
							index[i] = new Array();
							//console.log(i);
							$('#jmlist_'+(i+1)+" .fiveul").empty();
							$.each(data.seasons[i].programs, function (k, ktem) {

								/*
							        {
							          titlt:ktem.title,
							          artist:ktem.author,
							          mp3:ktem.audio.src,
							          poster:ktem.cover
							        }
							    */
							    if(ktem.author==null)
									ktem.author="主播";
								var mp3 = ktem.audio==null ? null : ktem.audio.src;
								var mp3id = ktem.audio.id==null ? null : ktem.audio.id;
								//console.log(mp3+" "+mp3id+" "+ktem.title+" "+playlist.length);
								var thumbnail = ktem.thumbnail==null ? ktem.cover : ktem.thumbnail;
								var background = ktem.background==null ? "http://newradio.sky31.com/images/bg.jpg" : ktem.background;
								var jtem = {
									title: ktem.title,
									artist: ktem.author,
									poster: ktem.cover,
									mp3: mp3,
									id: ktem.id,
									background: background
								};
								index[i][ktem.id] = new Object();

								index[i][ktem.id] = {
									id: ktem.id,
									index: k
								};
								//index[i].push(indexVar);
								//playListMain.push(jtem);
								playlist[i].push(jtem);
								titleX = ktem.title;
								if (ktem.title.length>8)
									ktem.title = ktem.title.substring(0,8) + '...';
									$('#jmlist_'+ktem.album_id+" .fiveul").append(
																	"<li>"
																		+"<a href=\""+"javascript:;"+"\" title=\""+titleX+"\" onclick=\"selectMusic("+i+","+ktem.id+")\"><img src=\""+thumbnail+"\" /></a>"
																		+"<a href=\""+"javascript:;"+"\" class=\"list_1\" title=\""+titleX+"\" onclick=\"selectMusic("+i+","+ktem.id+")\">"+ktem.title+"</a><br>"
																		+"<a href=\""+"javascript:;"+"\" class=\"list_2\">"+ktem.author+"</a>"
																	+"</li>");
									/*
									<li>
					                    <a href=""><img src="xx.jpg" /></a>
					                    <a href="" class="list_1">这里是一个列表推荐</a><br>
					                    <a href="" class="list_2">主播</a>
					                </li>
					                */
							});
			            });
						//console.log(playListMain);
						//console.log(playlist);
						//myPlaylist.setPlaylist(playListMain);
						$('#content').append("<script>"
							+"function selectMusic(plid,mpid)"
							+"{"
							+"	myPlaylist.setPlaylist(playlist[plid]);"
							+"	myPlaylist.select(index[plid][mpid].index);"
							+"	myPlaylist.play();"
							+"}"
							+"	</script>");
						$('#content').append("<script src=\"js/jquery.jplayer.min.js\"></script>");
			    		$('#content').append("<script src=\"js/jplayer.playlist.min.js\"></script>");
			            //$('jmlist').append("<script src=\"js/jquery.pageslide.js\"></script>");
					  	$('#jmlist').append("<script>$(\".first\").pageslide();$(\".second\").pageslide({ direction: \"left\", modal: true });</script>");
					  }
					});
  					flagSiji=1;
				}
			});
  	/*$(function() {
	      $("img.lazy").lazyload({effect: "fadeIn"});
	  });*/
  	var flagZhubo = 0;
  		$('#siderthree').click(function(){
  			/*<li class="list_3">
                    <a href="#zhubo_1" class="second"><img src="xx.png" alt="主播" /></a>
                    <a href="#zhubo_1" class="second"><span>听之</span></a>
                </li>*/
                if(flagZhubo==0){
                	$.ajax({
				  		crossDomain : true,
				              xhrFields: {
				                  withCredentials: false
				              },

						  url: "http://newradio.sky31.com/api/anchor",
						  //url: "js/api.js",
						  type: "get",
						  dataType: "json",
						  success:function(data){
						  	//console.log(data);
						  	$('#zhubo .fiveul').empty();
						  	$('#zhubocontent').empty();
						  	$.each(data,function(i,item){
						  		$('#zhubo .fiveul').append(
						  			"<li class='list_3'>"
						  				+"<a href='#zhubo_"+data[i].id+"' class='second2'><img src='"+data[i].avatar+"' alt='"+data[i].nickname+"' /></a>"
						  				+"<a href='#zhubo_"+data[i].id+"' class='second2'><span>"+data[i].nickname+"</span></a>"
						  			+"</li>"
						  			);
						  		$('#zhubocontent').append(
						  			'<div id="zhubo_'+data[i].id+'" class="slidepage">'
							            +'<h3><a href="#zhubo" class="second2 turn-left"></a><b>主播</b></h3>'
							            +'<ul class="fiveul">'
							                +'正在加载...'
							            +'</ul>'
							        +'</div>'
						  			);

						  	});
						  	$('#zhubocontent').append("<script>$(\".first1\").pageslide();$(\".second2\").pageslide({ direction: \"left\", modal: true });</script>");
						  	var flagZhuboList = 0;
						  	$('#zhubo .fiveul .list_3 .second2').click(function(){
					  			//console.log(this.outerHTML);
					  			var strDom = this.outerHTML;
					  			var strId = strDom.slice(strDom.indexOf('_')+1,strDom.indexOf("class")-2);
					  			//console.log(strId);
					  			if(flagZhuboList==0)
					  			{
					  				$.ajax({
									 	crossDomain : true,
									            xhrFields: {
									                withCredentials: false
									            },
									  url: "http://newradio.sky31.com/api/anchor/"+strId,
									  //url: "js/api.js",
									  type: "get",
									  dataType: "json",
									  success:function(data){
									  	$('#zhubo_'+strId+' .fiveul').empty();
									  	if(JSON.stringify(data) == "[]")
									  		$('#zhubo_'+strId+' .fiveul').append("该用户还没有发表节目哦，快去评论里告诉他你想听他的节目吧～");
									  	else {
									  		$.each(data, function (i, item) {
									            id = item.id;
									            title = item.title;
									            titleX = title;
									            if (item.title.length>8)
									                titleX = title.substring(0,8) + '...';
									            cover = item.cover;
									            if(item.cover==null)
									              cover = "cover";
									            album_id = item.album_id-1;
									            author = item.author;
									            if(item.author==null)
									              author = "author";
									            var thumbnail = item.thumbnail==null ? item.cover : item.thumbnail;
												$('#zhubo_'+strId+' .fiveul').append(
													"<li>"
														+"<a href=\""+"javascript:;"+"\" title=\""+titleX+"\" onclick=\"selectMusic("+album_id+","+id+")\"><img src=\""+thumbnail+"\" /></a>"
														+"<a href=\""+"javascript:;"+"\" class=\"list_1\" title=\""+title+"\" onclick=\"selectMusic("+album_id+","+id+")\">"+titleX+"</a><br>"
														+"<a href=\""+"javascript:;"+"\" class=\"list_2\">"+author+"</a>"
													+"</li>"
												);
										  	});
										  	//console.log(data);
										  }
									  //flagZhuboList=1;
									  }
									});
					  			}
					  		});
							$('#zhubo .fiveul .list_3 a img').bind("click",function(){
					    		if(this.alt=="CasparGX")
					    			alert("其实我不是主播呀，我只是捣乱的程序员～");
					    	});
					    	$('#zhubo .fiveul .list_3 a span').bind("click",function(){
					    		if(this=="CasparGX")
					    			alert("其实我不是主播呀，我只是捣乱的程序员～");
					    	});
						  }
						});
                	flagZhubo=1;
			  		}
                });
    $(window).load(function(){

	});
});
