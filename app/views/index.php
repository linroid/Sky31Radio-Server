<!DOCTYPE html>
<html lang="ch">
<head>
<meta charset="utf-8">
<title>四季电台 | 三翼校园</title>
<!-- <link rel="canonical" href="http://testweb.sky31.com"/> -->
<link rel="stylesheet" type="text/css" href="css/radio.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!--播放器-->
<link rel="stylesheet" type="text/css" href="css/player-style.css">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!--[if lt IE 10]>
    <link rel="stylesheet" type="text/css" href="css/ie-radio.css" />
<![endif]-->
<!--[if lt IE 9]>
    <script type="text/javascript">
        window.location="bs-ie.html";
    </script>
<![endif]-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?fc8e6c49658ec06fe981eb09d2d297b2";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?39b4cef0091ad94c0aef25b24bff13bf";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<div id="bygb1" style="float:left;width:100%;height:100%;min-height:600px;background-size:cover;overflow:hidden;background-image:url(images/bg.jpg);"></div>
<div id="bygb2" style="position:fixed;top:0px;left:0px;float:left;width:100%;height:100%;min-height:600px;background-size:cover;overflow:hidden;"></div>
<div id="content">
        <ul id="siderbar"><!--siderbar 是右侧滑动栏-->
        <div class="siderbar">
            <li><a href="#recommend" class="second" id="siderone">
                        <div class="siderbar-img"><img src="images/TUIJIAN.png" /></div>
                        <div class="siderbar-name">推 荐</div>
                    </a>
            </li>
            <li><a href="#radio" class="second" id="sidertwo">
                            <div class="siderbar-img"><img src="images/liebiao.png" /></div>
                            <div class="siderbar-name">四 季</div>
                    </a>
            </li>
            <li><a href="#zhubo" class="second" id="siderthree">
                        <div class="siderbar-img"><img src="images/zhubo.png" /></div>
                        <div class="siderbar-name">主 播</div>
                    </a>
            </li>
            <li><a href="#search" class="second" id="siderfour">
                            <div class="siderbar-img"><img src="images/search.png" /></div>
                            <div class="siderbar-name">搜索</div>
                    </a>
            </li>
            <li>
                <a href="#contact-us" class="second" id="siderfive">
                    <div class="siderbar-img"><img src="images/img/lianxi.png" /></div>
                    <div class="siderbar-name">关于我们</div>
                </a>
            </li>
            </div>
        </ul>
        <div class="nav"><!--logo-->
            <img src="images/img/logo.png" />
        </div>

        <!--下面是siderbar的滑出内容部分-->
        <div id="recommend" class="slidepage"><!--recommend 推荐列表-->
            <h3>最新节目</h3>
            <ul class="fiveul">

            </ul>
        </div>
        <div id="zhubo" class="slidepage"><!--zhubo 主播列表-->
            <form class="form-horizontal" role="form" id="search_column" style="display:none;">
                <div class="row form-group has-feedback">
                    <div class="col-xs-11">
                        <input type="text" class="form-control" placeholder="输入主播名">
                        <a href="#" style="color:#000;">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </a>
                    </div>
                </div>
            </form>
            <h3>主播</h3>
            <ul class="fiveul">
                正在加载...
                <!-- <li class="list_3">
                    <a href="#zhubo_1" class="second"><img src="xx.png" alt="主播" /></a>
                    <a href="#zhubo_1" class="second"><span>听之</span></a>
                </li> -->
            </ul>
        </div>

        <div id="radio" class="slidepage"><!--radio 四季列表-->
            <div class="radio_content_siji">
                <ul class="radio_column">
                    <li class="siji">
                        <a href="#jmlist_2" class="second">
                            <img src="images/img/spring.png" alt="春" />
                            <h3>春  音影书</h3>
                        </a>
                    </li>
                    <li class="siji">
                        <a href="#jmlist_3" class="second">
                            <img src="images/img/summer.png" alt="夏" />
                            <h3>夏  恋感情</h3>
                        </a>
                    </li>
                    <li class="siji">
                        <a href="#jmlist_4" class="second">
                            <img src="images/img/autunm.png" alt="秋" />
                            <h3>秋  生活行</h3>
                        </a>
                    </li>
                    <li class="siji">
                        <a href="#jmlist_5" class="second">
                            <img src="images/img/winter.png" alt="冬" />
                            <h3>冬  你我他</h3>
                        </a>
                    </li>
                    <li class="siji">
                        <a href="#jmlist_1" class="second">
                            <img src="images/img/qingchun.png" alt="青春祭" />
                            <h3>青春祭</h3>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="search" class="slidepage"><!--search 搜索列表-->
            <div class="form-horizontal" role="form" id="search_column">
                <div class="row form-group has-feedback">
                    <div class="col-xs-11">
                        <input id="searchBox" type="text" class="form-control" placeholder="搜索节目" value=""/>
                        <a href="javascript:;" style="color:#000;" onclick="searchAudio();">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="search_show" >
                <ul class="fiveul">
                </ul>
            </div>
        </div>
        <div id="contact-us" class="slidepage"><!--联系我们-->
            <div class="radio_content_siji">
                <h3>关于我们</h3>
                <div class="about">
                    <p>湘潭大学翼工坊负责三翼的各项技术研发工作。翼工坊下设产品策划、视觉设计、前端开发、后端开发、程序开发、移动端开发等几个小组，业务包括三翼校园网下设的湘大文库、四季电台等特色栏目的设计研发和日常维护，以及人力资源管理系统等内部人事资料管理产品等.</p>
                </div>
                <hr>
                <ul class="contact">
                    <li style="font-size:18px;font-weight:bold;">联系我们：</li>
                    <li>微信：isky31(湘潭大学三翼校园)</li>
                    <li>QQ：:148596141(四季电台)</li>
                    <li>微博：湘潭大学三翼校园</li>
                    <li>邮箱：radiosky31@qq.com</li>
                </ul>
             </div>
        </div>
        <!--siderbar的滑出内容部分结束-->

        <!--下面是四季栏目内容部分-->
        <div id="jmlist_1" class="slidepage">
            <h3><a href="#radio" class="second turn-left"></a><b>青春祭</b></h3>
            <ul class="fiveul">

            </ul>
        </div>
        <div id="jmlist_2" class="slidepage">
            <h3><a href="#radio" class="second turn-left"></a><b>春  音影书</b></h3>
                <ul class="fiveul">

                </ul>
        </div>
        <div id="jmlist_3" class="slidepage">
            <h3><a href="#radio" class="second turn-left"></a><b>夏  恋感情</b></h3>
            <ul class="fiveul">

            </ul>
        </div>
        <div id="jmlist_4" class="slidepage">
            <h3><a href="#radio" class="second turn-left"></a><b>秋  生活行</b></h3>
            <ul class="fiveul">

            </ul>
        </div>
        <div id="jmlist_5" class="slidepage">
            <h3><a href="#radio" class="second turn-left"></a><b>冬  你我他</b></h3>
            <ul class="fiveul">

            </ul>
        </div>
        <!--上面是四季栏目内容部分-->

        <!--zhubo_content-->
        <div id="zhubocontent">
            <!-- <div id="zhubo_5" class="slidepage">
            <h3><a href="#zhubo" class="second turn-left"></a><b>主播</b></h3>
            <ul class="fiveul">

            </ul>
             </div>-->
        </div>
        <!-- zhubo_content_end -->
        <!--zhongjiang-->
        <div class="eggs" style="display:none;">
             <h2>恭喜 ^_^</h2>
             <p> 恭喜您成为今天的幸运访问用户，将获得由三翼工作室提供的跨年礼品一份，请填写您的相关信息。</p>
             <form class="form-horizontal" role="form" id="eggs-form">
                <div class="col-md-7">
                    <div class="row">
                            <div class="form-group">
                  <label for="inputname" class="col-sm-2 control-label">姓名</label>
                  <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="inputname" placeholder="请输入姓名">
                  </div>
                </div>
                <div class="form-group">
                   <label for="inputschool" class="col-sm-2 control-label">学校</label>
                   <div class="col-sm-10">
                     <input name="school" type="text" class="form-control" id="inputschool" placeholder="请输入学校">
                   </div>
                 </div>
                <div class="form-group">
                  <label for="inputclass" class="col-sm-2 control-label">院系</label>
                  <div class="col-sm-10">
                    <input name="info" type="text" class="form-control" id="inputclass" placeholder="请输入院系">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputphone" class="col-sm-2 control-label">电话</label>
                  <div class="col-sm-10">
                    <input name="phone" type="tel    " class="form-control" id="inputphone" placeholder="请输入电话">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">提交</button>
                  </div>
                </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="jihuoma">jihuoma</div>
                    </div>
                </div>
            </form>
        </div>
        <!--下面是中间播放器-->
        <div class="center_radio" >
            <div class="music-player">
                <div class="info"><!--导航图部分-->

                    <div class="progress jp-seek-bar" style="margin-bottom:10px;">
                          <span class="jp-play-bar" style="width: 0%;"></span>
                    </div>

                    <div class="controls">
                      <div class="play-controls"><!--播放器控制按钮-->
                        <a href="javascript:;" class="icon-previous jp-previous bfq" title="上一首"></a>
                        <a href="javascript:;" class="icon-play jp-play bfq" title="开始"></a>
                        <a href="javascript:;" class="icon-pause jp-pause bfq" title="暂停"></a>
                        <a href="javascript:;" class="icon-next jp-next bfq" title="下一首"></a>
                      </div>
                      <div class="center">
                          <div class="jp-playlist" style="height:50px;">
                            <ul style="height:50px;">
                              <li style="margin-bottom:0px;"></li>
                            </ul>
                          </div>
                    </div>
                      <div class="center_radio_bottom"><!--评论，文稿及下载按钮-->
                          <a href="#comment" class="comment" id="showLeft" title="评论"></a>
                          <a href="#lyric" class="lyric" id="showTop" title="文稿"></a>
                          <a href="" target="_blank" class="download" title="下载"></a>
                      </div>
                      <!-- <div class="volume-level jp-volume-bar" style="display:none;">
                         <span class="jp-volume-bar-value" style="width: 0%"></span>
                         <a href="javascript:;" class="icon-volume-up jp-volume-max" title="最大"></a>
                         <a href="javascript:;" class="icon-volume-down jp-mute" title="静音"></a>
                       </div> -->
                    </div>
                </div>

                <div id="jquery_jplayer" class="jp-jplayer"></div>
            </div>
        </div>
        <!--播放器部分结束-->


        <!--节目文稿及评论滑出部分-->
        <div class="left-spmenu left-spmenu-vertical left-spmenu-left" id="comment">
            <div class="comment_content">
                <div class="comment_content_close" id="closeLeft"><img src="images/close.png" /></div>
                <div class="comment_content_title">评论</div>
                <div class="comment_content_neirong">

<div id="SOHUCS"></div>
<script>
  (function(){
    var appid = 'cyrxFx9hV',
    conf = 'prod_49380129f1bb772e61f950223cd36d2f';
    var doc = document,
    s = doc.createElement('script'),
    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
    s.type = 'text/javascript';
    s.charset = 'utf-8';
    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
    h.insertBefore(s,h.firstChild);
    window.SCS_NO_IFRAME = true;
  })()
</script>
                </div>
            </div>
        </div>
        <div class="left-spmenu left-spmenu-horizontal left-spmenu-top" id="lyric">
            <div class="lyric_content">
                <div class="lyric_content_close" id="closeTop"><img src="images/close.png" /></div>
                <div class="lyric_content_title">节目文稿</div>
                <div class="lyric_content_neirong">
                    <span class="neirong_title"></span>
                    <span class="neirong_writer"></span>
                    <div class="neirong_body">

                    </div>
                </div>
            </div>
        </div>
        <!--节目文稿及评论滑出部分结束-->

        <div id="copyright">
            <div class="row">
                <div class="col-md-3 col-xs-3"></div>
                <div class="col-md-6 col-xs-6">
                    <p>Copyright©2004-2014  湘潭大学<a href="http://www.sky31.com" target="_blank">三翼工作室</a>&nbsp;&nbsp;&nbsp;Powered by <a href="http://blog.sky31.com" target="_blank">翼工坊</a></p>
                </div>
                <div class="col-md-3 col-xs-3"></div>
            </div>
        </div>
</div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery.pageslide.js"></script><!--侧栏滑动-->
    <script type="text/javascript" src="js/jquery.dlmenu.js"></script>
    <script src="js/classie.js"></script><!--评论及歌单-->

    <!--播放器-->
    <script src="js/jquery.jplayer.min.js"></script>
    <script src="js/jplayer.playlist.min.js"></script>
    <script src="js/index.js"></script>
    <!-- <script src="js/index_0.js"></script> -->
    <script type="text/javascript" src="js/radioajax.js"></script>
    <script type="text/javascript">
            var menuLeft = document.getElementById( 'comment' ),
                menuTop = document.getElementById( 'lyric' ),
                showLeft = document.getElementById( 'showLeft' ),
                showTop = document.getElementById( 'showTop' ),
                closeLeft = document.getElementById('closeLeft'),
                closeTop = document.getElementById('closeTop'),
                body = document.body;

            showLeft.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( menuLeft, 'left-spmenu-open' );
            };
            showTop.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( menuTop, 'left-spmenu-open' );
            };
            closeLeft.onclick = function(){
                classie.toggle( this, 'active' );
                classie.toggle( menuLeft, 'left-spmenu-open' );
            };
            closeTop.onclick = function(){
                classie.toggle( this, 'active' );
                classie.toggle( menuTop, 'left-spmenu-open' );
            };
    </script>
    <script>
        $(".first").pageslide();
        $(".second").pageslide({ direction: "left", modal: true });
    </script>
<div style="display:none;">
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253998983'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/stat.php%3Fid%3D1253998983' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</body>
</html>
