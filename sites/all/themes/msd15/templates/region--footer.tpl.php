
  <div class="blk" style="background-color:#1F1F1F">
	  <div class="social-media-wrap">
		  <ul>
		  <li><a href="http://www.facebook.com/msdsocial" class="facebook">Like us on Facebook</a></li>
		  <li><a href="http://www.twitter.com/msdsocial" class="twitter">Follow us on Twitter</a></li>
		  <li><a href="http://www.youtube.com/user/ABPUnimelb" class="youtube">Watch MSD TV on Youtube</a></li>
		  <li><a href="http://www.linkedin.com/groups/ABP-UoM-4706402?gid=4706402&trk=nmp_rec_act_group_photo" class="linkedin">Join us on Linked in</a></li>
		  </ul>
	  </div>
  </div>
  
  
  <div class="blk" style="background-color:#292929">
  <div class="footer-links-wrap">
    <div class="double-clmn">
    
	    <div style="min-height:190px; margin-top:36px">
	      <?php
	      $block = block_load('msd2014', 'footer_left_column');
	      $build = _block_get_renderable_array(_block_render_blocks(array($block)));
	      print drupal_render($build);
	      ?>
	    </div>
	      
	    <div class="fine-txt">
    	  <?php
	      $block = block_load('msd2014', 'footer_site_ownership');
	      $build = _block_get_renderable_array(_block_render_blocks(array($block)));
	      print drupal_render($build);
	      ?>
	    </div>
     
    </div>
    
    <div class="single-clmn">
    
	    <div style="min-height:190px; margin-top:36px">
	      <?php
	      $block = block_load('msd2014', 'footer_center_column');
	      $build = _block_get_renderable_array(_block_render_blocks(array($block)));
	      print drupal_render($build);
	      ?>
	    </div>
	    
		<div class="fine-txt">
			We acknowledge that the Parkville campus<br>
	  		is located on Wurundjeri land.
	  	</div>
    
    </div>
    
    <div class="single-clmn single-clmn-wide right-column">
    <div class="box">
	    <?php
	    $block = block_load('msd2014', 'footer_right_column');
	    $build = _block_get_renderable_array(_block_render_blocks(array($block)));
	    print drupal_render($build);
	    ?> 
	</div>
	<div class="box footer-enews-subscribe">
	    <?php
	    $block = block_load('msd2014', 'footer_subscribe_enews');
	    $build = _block_get_renderable_array(_block_render_blocks(array($block)));
	    print drupal_render($build);
	    ?> 
	</div>
    </div>

  
  </div> 
  
  
