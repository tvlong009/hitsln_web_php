<?php //frontend\assets\HomeAsset::register($this)  ?>
<!-- ===================== Page Content =====================-->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row top_bar_content" >

            <!-- ==========    Top Banner COntent ==========    -->	
            
            <?php echo \backend\modules\slidewidget\widgets\SlideWidget::widget(['name'=>'Slide_1','template'=>'
                {{begin slide}}
                <div class="col-lg-10">
                        <div class="banner_content">
                        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

								  <div class="carousel-inner" role="listbox">
                                  {{begin item}}
								 
								    <div class="item">
								    	 <img src="{{image}}" alt="">
								    </div>	
                                  {{end item}}
								  </div>							

								</div>
								
                        </div>
                    </div>
                    {{end slide}}']); ?>
          
            <!-- End left column -->

            <div class="col-lg-2 position_relative">
                <div class="menu_right_bar_absolute">
                    <ul class="nav" id="right-menu">  
                        <li>
                            <a href="myaccount.html">
                                <i class="fa fa-home icon_parent"></i> My Account </a>
                        </li>

                        <li>
                            <a href="myaccount.html">
                                <i class="fa fa-paper-plane icon_parent"></i> Promotion </a>
                        </li>

                        <li>
                            <a href="myaccount.html">
                                <i class="fa fa-gear icon_parent"></i> Settings </a>
                        </li>

                        <li>
                            <a href="myaccount.html">
                                <i class="fa fa-bullhorn icon_parent"></i> Radio </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-ellipsis-h  icon_parent"></i> More 
                                <span class="fa arrow"></span>
                            </a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="album.html">
                                        <i class="fa fa-ellipsis-h icon_child"></i>
                                        Album
                                    </a>
                                </li>
                                <li>  
                                    <a href="buttons.html">
                                        <i class="icon-users icon_child"></i>
                                        Artiesten</a>
                                </li>		                                                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
            </div>
            <!-- ==========   Start COntent ==========    --> 

            <div class="col-lg-12 main_content_page">
                <div class="row">

                    <div class="col-md-10 list_tab">
                        <ul class="filter_item">
                            <li  data-target="all"   class="active">OVERVIEW </li>
                            <li  data-target="#toptrack">TOP LISTS </li>
                            <li  data-target="#topalbums" >GENRES & MOODS  </li>
                            <li  data-target="#hitsnl_top30">NEW RELEASES</li>
                            <li  data-target="#news_discover">NEWS DISCOVER</li>
                        </ul>
                    </div>

                    <div class="col-md-2 box_view">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">View</label>
                            <div class="col-sm-10">
                                <select class="form-control selectbox_radius">
                                    <option value="#">Art work</option>		
                                    <option value="#">Art work</option>		
                                    <option value="#">Art work</option>		
                                    <option value="#">Art work</option>		
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- Start TOP TRACK -->
                    <?php echo \backend\modules\slidewidget\widgets\SlideWidget::widget(['name'=>'Slide_1','template'=>' 
                    {{begin slide}}
                    <div id="toptrack" class="col-md-12 row_item">
                        <div class="row title_row_item">
                            <i class="fa fa-play"></i>
                            TOP TRACKS
                            <div class="arrow_item pull-right">
                                <i data-itemnumber="0" class="fa fa-angle-left btn_prev_item"></i>
                                <i data-itemnumber="0" class="fa fa-angle-right btn_next_item"></i>
                            </div>
                        </div>

                        <div class="row item_list">
                            {{begin item}}
                            <div class="col-md-2 item">
                                <div class="img_item right_click">                  		<div class="mark_item">
                                        <i class="fa fa-play"></i>
                                    </div>			
                                    <img src="{{image}}" alt="">

                                </div>
                                <div>
                                    <h4><a href="#">{{title}}</a></h3>
                                        <p>{{description}}</p>
                                </div> 
                                <div>&nbsp;</div>               						
                            </div>
                            {{end item}}
                        </div>
                    </div>
                    {{end slide}}
                    ']);?>
                    <!--End a row list item Top Track-->  





                    <!-- Start TOP ALBUMS -->
                          <?php echo \backend\modules\slidewidget\widgets\SlideWidget::widget(['name'=>'Slide_1','template'=>' 
                    {{begin slide}}
                    <div id="topalbums" class="col-md-12 row_item">
                        <div class="row title_row_item">
                            <i class="fa fa-play"></i>
                            TOP TRACKS
                            <div class="arrow_item pull-right">
                                <i data-itemnumber="0" class="fa fa-angle-left btn_prev_item"></i>
                                <i data-itemnumber="0" class="fa fa-angle-right btn_next_item"></i>
                            </div>
                        </div>

                        <div class="row item_list">
                            {{begin item}}
                            <div class="col-md-2 item">
                                <div class="img_item right_click">                  		<div class="mark_item">
                                        <i class="fa fa-play"></i>
                                    </div>			
                                    <img src="{{image}}" alt="">

                                </div>
                                <div>
                                       <h4><a href="#">{{title}}</a></h3>
                                        <p>{{description}}</p>
                                </div> 
                                <div>&nbsp;</div>               						
                            </div>
                            {{end item}}
                        </div>
                    </div>
                    {{end slide}}
                    ']);?>
                    <!-- End a row list item TOP ALBUMS -->



                    <!-- Start HITSNL TOP 30 -->
                    
                    <?php echo \backend\modules\slidewidget\widgets\SlideWidget::widget(['name'=>'Slide_1','template'=>' 
                    {{begin slide}}
                    <div id="hitsnl_top30" class="col-md-12 row_item">
                        <div class="row title_row_item">
                            <i class="fa fa-play"></i>
                            TOP TRACKS
                            <div class="arrow_item pull-right">
                                <i data-itemnumber="0" class="fa fa-angle-left btn_prev_item"></i>
                                <i data-itemnumber="0" class="fa fa-angle-right btn_next_item"></i>
                            </div>
                        </div>

                        <div class="row item_list">
                            {{begin item}}
                            <div class="col-md-2 item">
                                <div class="img_item right_click">                  		<div class="mark_item">
                                        <i class="fa fa-play"></i>
                                    </div>			
                                    <img src="{{image}}" alt="">

                                </div>
                                <div>
                                        <h4><a href="#">{{title}}</a></h3>
                                        <p>{{description}}</p>
                                </div> 
                                <div>&nbsp;</div>               						
                            </div>
                            {{end item}}
                        </div>
                    </div>
                    {{end slide}}
                    ']);?>
                    <!-- End a row list item HITSNL TOP 30 -->



                    <!-- Start NEWS DISCOVER -->
                         <?php echo \backend\modules\slidewidget\widgets\SlideWidget::widget(['name'=>'Slide_1','template'=>' 
                    {{begin slide}}
                    <div id="news_discover" class="col-md-12 row_item">
                        <div class="row title_row_item">
                            <i class="fa fa-play"></i>
                            TOP TRACKS
                            <div class="arrow_item pull-right">
                                <i data-itemnumber="0" class="fa fa-angle-left btn_prev_item"></i>
                                <i data-itemnumber="0" class="fa fa-angle-right btn_next_item"></i>
                            </div>
                        </div>

                        <div class="row item_list">
                            {{begin item}}
                            <div class="col-md-2 item">
                                <div class="img_item right_click">                  		<div class="mark_item">
                                        <i class="fa fa-play"></i>
                                    </div>			
                                    <img src="{{image}}" alt="">

                                </div>
                                <div>
                                        <h4><a href="#">{{title}}</a></h3>
                                        <p>{{description}}</p>
                                </div> 
                                <div>&nbsp;</div>               						
                            </div>
                            {{end item}}
                        </div>
                    </div>
                    {{end slide}}
                    ']);?>
                    <!-- End a row list item NEWS DISCOVER -->





                </div>
                <!-- End a row -->
            </div>

            <!-- ==========   END COntent ==========    --> 
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- ===================== /#page-wrapper ===================== -->