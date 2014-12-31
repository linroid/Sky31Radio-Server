$(function(){
        $("#searchBox").bind('keypress',function(event){
            if(event.keyCode == "13")
            {
                var keyword = $(this).val();
                searchFn(keyword);
            }
        });
    });

/*function reqUyan(id) {  //you yan ping lun

$('#comment_content_neirong').empty();
$('#comment_content_neirong').append("<div id=\"uyan_frame\"></div>");
$('#comment_content_neirong').append("<script type=\"text/javascript\">"
                    +"var uyan_config = {"
                    +     "'title':'',"
                    +     "'url':'',"
                    +     "'pic':'',"
                    +     "'vid':'',"
                    +     "'du':'',"
                    +     "'su':'"+id+"'"
                    +"};"
                    +"</script>");
$('#comment_content_neirong').append("<script type=\"text/javascript\" src=\"http://v2.uyan.cc/code/uyan.js?uid=1995663\"></script>");

}*/
function changeBg(bg){ //change background;
//$('#content').attr('style','background-image:url('+bg+')');
$('#bygb1').css({"background-image":$('#bygb2').css("background-image")});
$('#bygb2').animate({opacity:'0'},0);
$('#bygb2').css({"background-image":"url("+bg+")"});
$('#bygb2').animate({opacity:'1'},"slow");
}
function changeDownload(mp3){
  $('.download').attr('href',mp3+'?download');
}

function cyjz(){
    var appid = 'cyrxbOfft',
    conf = 'prod_a29932cfcb094ae87760122f2e0cab30';
    var doc = document,
    s = doc.createElement('script'),
    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
    s.type = 'text/javascript';
    s.charset = 'utf-8';
    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
    h.insertBefore(s,h.firstChild);
    window.SCS_NO_IFRAME = true;
  }
function reqChangYan(id){   //request ChangYan and change the talk part
  //$('#SOHUCS').attr("sid",id);

  $('.comment_content_neirong').empty();
  $('.comment_content_neirong').append(
      "<div id=\"SOHUCS\" sid=\""+id+"\"></div>"
      +"<script>"
      +"  (function(){"
      +"    var appid = 'cyrxbOfft',"
      +"    conf = 'prod_a29932cfcb094ae87760122f2e0cab30';"
      +"    var doc = document,"
      +"    s = doc.createElement('script'),"
      +"    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;"
      +"    s.type = 'text/javascript';"
      +"    s.charset = 'utf-8';"
      +"    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;"
      +"    h.insertBefore(s,h.firstChild);"
      +"    window.SCS_NO_IFRAME = true;"
      +"  })()"
      +"</script>"
    );
  //console.log($('#SOHUCS'));

}

function reqWG(id) {
  $('.lyric_content_neirong .neirong_body').empty();
  $('.lyric_content_neirong .neirong_title').empty();
  $('.lyric_content_neirong .neirong_writer').empty();
  $('.lyric_content_neirong .neirong_title').append("正在加载...");
  menuTop = document.getElementById( 'lyric' );
  showTop = document.getElementById( 'showTop' );
  closeTop = document.getElementById('closeTop');
  body = document.body;
  classie.toggle( showTop, 'active' );
  classie.toggle( menuTop, 'left-spmenu-open' );
  ajaxWG(id);
}

function ajaxWG(id) {
  $.ajax({
      crossDomain : true,
              xhrFields: {
                  withCredentials: false
              },

      url: "http://newradio.sky31.com/api/program/"+id,
      //url: "http://sky31.xtuers.com/api/all",
      //url: "js/api.js",
      type: "get",
      dataType: "json",
      success:function(data){
            article = data.article;
            author = data.author;
            title = data.title;
            $('.lyric_content_neirong .neirong_title').empty();
            $('.lyric_content_neirong .neirong_body').append(article);
            $('.lyric_content_neirong .neirong_title').append(title);
            $('.lyric_content_neirong .neirong_writer').append("主播:"+author);
          }
      })
    }

function searchAudio() {
    var keyword = $("input[type='text']")[2].value;
    searchFn(keyword);
  }

  function searchFn(keyword){
    $('#search_show .fiveul').empty();//清空已经存在的搜索结果
    $('#search_show .fiveul').append("<br/>正在搜索...");
    $.ajax({
      crossDomain : true,
              xhrFields: {
                  withCredentials: false
              },

      url: "http://newradio.sky31.com/api/search?keyword="+keyword,
      //url: "http://sky31.xtuers.com/api/all",
      //url: "js/api.js",
      type: "get",
      dataType: "json",
      success:function(data){
            $('#search_show .fiveul').empty();//清空已经存在的搜索结果
        //console.log(data);
        if(JSON.stringify(data) == "[]")
            $('#search_show .fiveul').append("<br/>你搜索的节目没有哦～");
          else{
            $.each(data, function (i, item) {
            id = item.id;
            title = item.title;
            titleX = title;
            if (title.length>8)
                titleX = title.substring(0,8) + '...';
            cover = item.cover;
            if(item.cover==null)
              cover = "cover";
            album_id = item.album_id-1;
            author = item.author;
            if(item.author==null)
              author = "author";
            var thumbnail = item.thumbnail==null ? null : item.thumbnail;
           // console.log(id+title+cover+album_id+author);
            $('#search_show .fiveul').append("<li>"
                          +"<a href=\""+"javascript:;"+"\" title=\""+title+"\" onclick=\"selectMusic("+album_id+","+id+")\"><img src=\""+thumbnail+"\" /></a>"
                          +"<a href=\""+"javascript:;"+"\" class=\"list_1\" title=\""+title+"\" onclick=\"selectMusic("+album_id+","+id+")\">"+titleX+"</a><br>"
                          +"<a href=\""+"javascript:;"+"\" class=\"list_2\">"+author+"</a>"
                        +"</li>");
                });
          }
      }
    });
  }

